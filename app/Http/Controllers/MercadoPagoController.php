<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use App\Models\Reserva;
use App\Models\Sala;
use App\Models\Transacao;
use Illuminate\Support\Facades\Log;

class MercadoPagoController extends Controller
{
    public function testeFixo()
    {
        try {
            SDK::setAccessToken(config('services.mercadopago.access_token'));

            $item = new Item();
            $item->title = 'Teste de Produto Fictício';
            $item->quantity = 1;
            $item->unit_price = 123.45;

            $preference = new Preference();
            $preference->items = [$item];

            // Corrigido: objeto stdClass
            $payer = new \stdClass();
            $payer->name = "João";
            $payer->surname = "Silva";
            $payer->email = "comprador_teste@example.com";
            $payer->phone = new \stdClass();
            $payer->phone->area_code = "11";
            $payer->phone->number = "999999999";

            $preference->payer = $payer;

            $preference->back_urls = [
                "success" => url('/obrigado'),
                "failure" => url('/falhou'),
                "pending" => url('/aguardando')
            ];

            $preference->auto_return = "approved";

            $preference->save();

            return response()->json([
                'status' => '✅ Preferência criada',
                'init_point' => $preference->init_point,
                'id_preferencia' => $preference->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '❌ Erro',
                'erro' => $e->getMessage()
            ], 500);
        }
    }





    public function pagar($reservaId)
    {
        try {
            SDK::setAccessToken(config('services.mercadopago.access_token'));

            $reserva = Reserva::with('usuario', 'horarios', 'sala')->findOrFail($reservaId);
            $valorTotal = $reserva->valor_total;

            // Validação simples de segurança
            if (!$valorTotal || $valorTotal <= 0) {
                throw new \Exception("Valor total inválido: {$valorTotal}");
            }

            // Item de pagamento
            $item = new Item();
            $item->title = 'Reserva de sala - ' . ($reserva->sala->nome ?? 'Sem nome');
            $item->quantity = 1;
            $item->unit_price = (float) str_replace(',', '.', $valorTotal);

            // Criar a preferência
            $preference = new Preference();
            $preference->items = [$item];

            // Objeto payer como stdClass
            $usuario = $reserva->usuario;

            $payer = new \stdClass();
            $payer->name = $usuario->name ?? "Teste";
            $payer->surname = "";
            $payer->email = $usuario->email ?? "comprador_teste@example.com";

            $payer->phone = new \stdClass();
            $payer->phone->area_code = "11";
            $payer->phone->number = preg_replace('/[^0-9]/', '', $usuario->telefone ?? "999999999");

            $payer->identification = new \stdClass();
            $payer->identification->type = "CPF";
            $payer->identification->number = preg_replace('/[^0-9]/', '', $usuario->cpf ?? "19119119100");

            $payer->address = new \stdClass();
            $payer->address->zip_code = preg_replace('/[^0-9]/', '', $usuario->cep ?? "06233200");
            $payer->address->street_name = $usuario->rua ?? "Av. das Nações Unidas";
            $payer->address->street_number = $usuario->numero ?? "3003";
            $payer->address->neighborhood = $usuario->bairro ?? "Bonfim";
            $payer->address->city = $usuario->cidade ?? "Osasco";
            $payer->address->federal_unit = $usuario->estado ?? "SP";

            $preference->payer = $payer;

            $preference->back_urls = [
                "success" => route('pagamento.sucesso'),
                "failure" => route('pagamento.erro'),
                "pending" => route('pagamento.pendente'),
            ];

            $preference->auto_return = "approved";
            $preference->external_reference = $reserva->id;

            $preference->save();

            Log::info('Preferência Mercado Pago gerada:', [
                'id' => $preference->id,
                'init_point' => $preference->init_point,
                'sandbox_init_point' => $preference->sandbox_init_point,
            ]);

            $link = $preference->init_point ?: $preference->sandbox_init_point;

            if (!$link) {
                return response()->json([
                    'success' => false,
                    'error' => 'Nenhum link de pagamento retornado.',
                    'motivo' => 'init_point e sandbox_init_point vazios',
                    'preferencia_id' => $preference->id ?? null
                ]);
            }

            return response()->json([
                'success' => true,
                'redirect' => $link,
                'reference_id' => 'reserva_' . $reserva->id,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Erro ao gerar link de pagamento.',
                'mensagem' => $e->getMessage(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
            ]);
        }
    }



    public function webhook(Request $request)
    {
        $body = json_decode($request->getContent(), true);

        Log::info('🔔 Webhook Mercado Pago', $body);

        if (isset($body['type']) && $body['type'] === 'payment') {
            $paymentId = $body['data']['id'];

            // Consulta a API para pegar detalhes do pagamento
            $url = "https://api.mercadopago.com/v1/payments/{$paymentId}?access_token=" . config('services.mercadopago.access_token');
            $response = json_decode(file_get_contents($url), true);

            $reservaId = $response['external_reference'] ?? null;

            if ($reservaId) {
                Transacao::updateOrCreate(
                    ['external_id' => $response['id']],
                    [
                        'user_id' => $response['payer']['id'] ?? null,
                        'reserva_id' => $reservaId,
                        'status' => $response['status'],
                        'metodo' => $response['payment_method_id'],
                        'valor' => $response['transaction_amount'],
                        'payload' => json_encode($response),
                    ]
                );
            }
        }

        return response()->json(['status' => 'ok']);
    }

    public function status($reservaId)
    {
        $transacao = \App\Models\Transacao::where('reserva_id', $reservaId)->latest()->first();

        if (!$transacao) {
            return response()->json(['status' => 'NAO_ENCONTRADO'], 404);
        }

        if ($transacao->status === 'approved') {
            return response()->json(['status' => 'PAGA']);
        } elseif ($transacao->status === 'pending') {
            return response()->json(['status' => 'PENDENTE']);
        } elseif ($transacao->status === 'rejected') {
            return response()->json(['status' => 'REJEITADA']);
        } else {
            return response()->json(['status' => strtoupper($transacao->status)]);
        }
    }


    public function sucesso()
    {
        return view('pagamento.sucesso');
    }
    public function erro()
    {
        return view('pagamento.erro');
    }
    public function pendente()
    {
        return view('pagamento.pendente');
    }
}
