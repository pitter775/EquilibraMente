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
use Illuminate\Support\Facades\Http;
use App\Models\DebugLog;

class MercadoPagoController extends Controller
{
    public function webhook(Request $request)
    {
        $body = json_decode($request->getContent(), true);

        DebugLog::create([
            'mensagem' => '📥 Webhook recebido: ' . json_encode($body)
        ]);

        try {
            if (isset($body['type']) && $body['type'] === 'payment') {
                $paymentId = $body['data']['id'] ?? null;

                DebugLog::create([
                    'mensagem' => '🔎 paymentId recebido: ' . $paymentId
                ]);

                if ($paymentId && is_numeric($paymentId)) {
                    $url = "https://api.mercadopago.com/v1/payments/{$paymentId}";
                    $response = Http::withToken(config('services.mercadopago.access_token'))->get($url);

                    DebugLog::create([
                        'mensagem' => '📡 Resposta da API Mercado Pago: ' . $response->body()
                    ]);

                    $data = $response->json();
                    $reservaId = $data['external_reference'] ?? null;

                    if ($reservaId) {
                        Transacao::updateOrCreate(
                            ['external_id' => $data['id']],
                            [
                                'user_id' => $data['payer']['id'] ?? null,
                                'reserva_id' => $reservaId,
                                'status' => $data['status'],
                                'metodo' => $data['payment_method_id'],
                                'valor' => $data['transaction_amount'],
                                'payload' => json_encode($data),
                            ]
                        );

                        DebugLog::create([
                            'mensagem' => '✅ Transação atualizada com sucesso - reserva_id: ' . $reservaId
                        ]);
                    } else {
                        DebugLog::create([
                            'mensagem' => '⚠️ Falha: reserva_id não encontrado na resposta.'
                        ]);
                    }
                } else {
                    DebugLog::create([
                        'mensagem' => '⚠️ paymentId inválido: ' . json_encode($paymentId)
                    ]);
                }
            } else {
                DebugLog::create([
                    'mensagem' => '⚠️ Tipo de evento ignorado ou ausente: ' . ($body['type'] ?? 'nenhum')
                ]);
            }
        } catch (\Throwable $e) {
            DebugLog::create([
                'mensagem' => '❌ Exceção capturada: ' . $e->getMessage()
            ]);
        }

        return response()->json(['status' => 'ok'], 200);
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
