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
    public function pagar($reservaId)
    {
        SDK::setAccessToken(config('services.mercadopago.access_token'));

        $reserva = Reserva::with('usuario', 'horarios', 'sala')->findOrFail($reservaId);
        $valorTotal = $reserva->valor_total;

        $item = new Item();
        $item->title = 'Reserva de sala - ' . $reserva->sala->nome;
        $item->quantity = 1;
        $item->unit_price = $valorTotal;

        $preference = new Preference();
        $preference->items = [$item];

        // Enviar dados do comprador (payer)
        $usuario = $reserva->usuario;
        $preference->payer = [
            "name" => $usuario->name ?? "Teste",
            "surname" => "",
            "email" => $usuario->email ?? "comprador_teste@example.com",
            "phone" => [
                "area_code" => "11",
                "number" => preg_replace('/[^0-9]/', '', $usuario->telefone ?? "999999999")
            ],
            "identification" => [
                "type" => "CPF",
                "number" => preg_replace('/[^0-9]/', '', $usuario->cpf ?? "19119119100")
            ],
            "address" => [
                "zip_code" => preg_replace('/[^0-9]/', '', $usuario->cep ?? "06233200"),
                "street_name" => $usuario->rua ?? "Av. das Nações Unidas",
                "street_number" => $usuario->numero ?? "3003",
                "neighborhood" => $usuario->bairro ?? "Bonfim",
                "city" => $usuario->cidade ?? "Osasco",
                "federal_unit" => $usuario->estado ?? "SP"
            ]
        ];

        $preference->back_urls = [
            "success" => route('pagamento.sucesso'),
            "failure" => route('pagamento.erro'),
            "pending" => route('pagamento.pendente'),
        ];
        $preference->auto_return = "approved";

        // Envia ID da reserva para retornar no webhook
        $preference->external_reference = $reserva->id;

        $preference->save();

        return redirect($preference->init_point);
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
