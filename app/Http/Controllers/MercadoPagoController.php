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
        DebugLog::create(['mensagem' => '📥 Payload recebido no webhook: ' . json_encode($body)]);

        try {
            if (isset($body['type']) && $body['type'] === 'payment') {
                $paymentId = $body['data']['id'] ?? null;
                DebugLog::create(['mensagem' => '🔍 paymentId recebido: ' . $paymentId]);

                if ($paymentId && is_numeric($paymentId)) {
                    $response = Http::withToken(config('services.mercadopago.access_token'))
                                    ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
                                    ->json();

                    DebugLog::create(['mensagem' => '📦 Resposta da API Mercado Pago: ' . json_encode($response)]);

                    $reservaId = $response['external_reference'] ?? null;
                    DebugLog::create(['mensagem' => '🔗 Reserva ID extraída: ' . $reservaId]);

                    if ($reservaId) {
                        Transacao::updateOrCreate(
                            ['reference_id' => $reservaId],
                            [
                                'usuario_id' => $response['payer']['id'] ?? null,
                                'sala_id' => $reserva->sala_id ?? null,
                                'status' => $response['status'] ?? 'indefinido',
                                'valor' => $response['transaction_amount'] ?? 0,
                                'pagbank_order_id' => null,
                                'detalhes' => $response,
                            ]
                        );

                        DebugLog::create(['mensagem' => '✅ Transação atualizada com sucesso para reserva: ' . $reservaId]);
                    } else {
                        DebugLog::create(['mensagem' => "⚠️ Webhook sem external_reference para pagamento {$paymentId}"]);
                    }
                } else {
                    DebugLog::create(['mensagem' => "⚠️ paymentId inválido: " . print_r($paymentId, true)]);
                }
            } else {
                DebugLog::create(['mensagem' => "⚠️ Webhook ignorado - tipo: " . ($body['type'] ?? 'indefinido')]);
            }
        } catch (\Throwable $e) {
            DebugLog::create(['mensagem' => '❌ Erro no webhook: ' . $e->getMessage()]);
            Log::error("❌ Erro no Webhook Mercado Pago: " . $e->getMessage());
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
