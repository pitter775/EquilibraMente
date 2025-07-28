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
        DebugLog::create(['mensagem' => '🔔 Webhook recebido: ' . json_encode($body)]);

        try {
            if (isset($body['type']) && $body['type'] === 'payment') {
                $paymentId = $body['data']['id'] ?? null;

                if ($paymentId && is_numeric($paymentId)) {
                    $response = Http::withToken(config('services.mercadopago.access_token'))
                        ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
                        ->json();

                    DebugLog::create(['mensagem' => '📥 Resposta do MP: ' . json_encode($response)]);

                    $reservaId = $response['external_reference'] ?? null;

                    if ($reservaId) {
                        $reservaIdLimpo = str_replace('reserva_', '', $reservaId);

                        if (!is_numeric($reservaIdLimpo)) {
                            DebugLog::create(['mensagem' => '⚠️ ID de reserva inválido: ' . $reservaId]);
                            return response()->json(['mensagem' => 'ID de reserva inválido'], 200);
                        }

                        $reserva = Reserva::find($reservaIdLimpo);

                        if (!$reserva) {
                            DebugLog::create(['mensagem' => '⚠️ Reserva não encontrada: ' . $reservaId]);
                            return response()->json(['mensagem' => 'Reserva não encontrada'], 200);
                        }

                        Transacao::updateOrCreate(
                            ['external_id' => $response['id']],
                            [
                                'reference_id' => 'reserva_' . $reserva->id,
                                'usuario_id' => $reserva->usuario_id,
                                'sala_id' => $reserva->sala_id,
                                'status' => $response['status'],
                                'valor' => $response['transaction_amount'],
                                'pagbank_order_id' => $response['order']['id'] ?? null,
                                'detalhes' => json_encode($response),
                            ]
                        );

                        if ($response['status'] === 'approved') {
                            $reserva->update(['status' => 'CONFIRMADA']);
                            DebugLog::create(['mensagem' => '✅ Reserva confirmada: ID ' . $reserva->id]);
                        } elseif (in_array($response['status'], ['rejected', 'cancelled', 'refunded', 'charged_back'])) {
                            $reserva->update(['status' => 'CANCELADA']);
                            DebugLog::create(['mensagem' => '🚫 Reserva cancelada: ID ' . $reserva->id]);
                        } else {
                            $reserva->update(['status' => 'PENDENTE']);
                            DebugLog::create(['mensagem' => '⏳ Reserva pendente: ID ' . $reserva->id]);
                        }
                    } else {
                        DebugLog::create(['mensagem' => '⚠️ Webhook sem external_reference']);
                    }
                } else {
                    DebugLog::create(['mensagem' => '⚠️ Payment ID inválido: ' . json_encode($paymentId)]);
                }
            }
        } catch (\Throwable $e) {
            DebugLog::create(['mensagem' => '❌ Erro no webhook: ' . $e->getMessage()]);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function sucesso(Request $request)
    {
        $status = $request->input('status');
        $paymentId = $request->input('payment_id');
        $externalReference = $request->input('external_reference');

        if ($status && $paymentId && $externalReference) {
            DebugLog::create(['mensagem' => '✅ Callback via URL de sucesso: ' . $paymentId]);

            try {
                $reservaId = str_replace('reserva_', '', $externalReference);
                $reserva = Reserva::find($reservaId);

                if ($reserva) {
                    $response = Http::withToken(config('services.mercadopago.access_token'))
                        ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
                        ->json();

                    Transacao::updateOrCreate(
                        ['external_id' => $response['id']],
                        [
                            'reference_id' => 'reserva_' . $reserva->id,
                            'usuario_id' => $reserva->usuario_id,
                            'sala_id' => $reserva->sala_id,
                            'status' => $response['status'],
                            'valor' => $response['transaction_amount'],
                            'pagbank_order_id' => $response['order']['id'] ?? null,
                            'detalhes' => json_encode($response),
                        ]
                    );

                    if ($response['status'] === 'approved') {
                        $reserva->update(['status' => 'CONFIRMADA']);
                    } elseif (in_array($response['status'], ['rejected', 'cancelled', 'refunded', 'charged_back'])) {
                        $reserva->update(['status' => 'CANCELADA']);
                    } else {
                        $reserva->update(['status' => 'PENDENTE']);
                    }
                }
            } catch (\Throwable $e) {
                DebugLog::create(['mensagem' => '❌ Erro no sucesso(): ' . $e->getMessage()]);
            }
        }

        return view('pagamento.sucesso');
    }

    public function erro(Request $request)
    {
        $externalReference = $request->input('external_reference');
        $paymentId = $request->input('payment_id');

        if ($externalReference && $paymentId) {
            try {
                $reservaId = str_replace('reserva_', '', $externalReference);
                $reserva = Reserva::find($reservaId);

                if ($reserva) {
                    $response = Http::withToken(config('services.mercadopago.access_token'))
                        ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
                        ->json();

                    Transacao::updateOrCreate(
                        ['external_id' => $response['id']],
                        [
                            'reference_id' => 'reserva_' . $reserva->id,
                            'usuario_id' => $reserva->usuario_id,
                            'sala_id' => $reserva->sala_id,
                            'status' => $response['status'],
                            'valor' => $response['transaction_amount'],
                            'pagbank_order_id' => $response['order']['id'] ?? null,
                            'detalhes' => json_encode($response),
                        ]
                    );

                    $reserva->update(['status' => 'CANCELADA']);
                }
            } catch (\Throwable $e) {
                DebugLog::create(['mensagem' => '❌ Erro no erro(): ' . $e->getMessage()]);
            }
        }

        return view('pagamento.erro');
    }

    public function pendente(Request $request)
    {
        $externalReference = $request->input('external_reference');
        $paymentId = $request->input('payment_id');

        if ($externalReference && $paymentId) {
            try {
                $reservaId = str_replace('reserva_', '', $externalReference);
                $reserva = Reserva::find($reservaId);

                if ($reserva) {
                    $response = Http::withToken(config('services.mercadopago.access_token'))
                        ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
                        ->json();

                    Transacao::updateOrCreate(
                        ['external_id' => $response['id']],
                        [
                            'reference_id' => 'reserva_' . $reserva->id,
                            'usuario_id' => $reserva->usuario_id,
                            'sala_id' => $reserva->sala_id,
                            'status' => $response['status'],
                            'valor' => $response['transaction_amount'],
                            'pagbank_order_id' => $response['order']['id'] ?? null,
                            'detalhes' => json_encode($response),
                        ]
                    );

                    $reserva->update(['status' => 'PENDENTE']);
                }
            } catch (\Throwable $e) {
                DebugLog::create(['mensagem' => '❌ Erro no pendente(): ' . $e->getMessage()]);
            }
        }

        return view('pagamento.pendente');
    }

    public function status($reservaId)
    {
        $reservaIdLimpo = str_replace('reserva_', '', $reservaId);

        $transacao = Transacao::where('reference_id', $reservaId)
            ->orWhere('reference_id', 'reserva_' . $reservaIdLimpo)
            ->latest()
            ->first();

        if (!$transacao) {
            return response()->json(['status' => 'NAO_ENCONTRADO'], 404);
        }

        $mapa = [
            'approved' => 'PAGA',
            'pending' => 'PENDENTE',
            'rejected' => 'REJEITADA',
            'cancelled' => 'CANCELADA',
        ];

        return response()->json([
            'status' => $mapa[$transacao->status] ?? strtoupper($transacao->status),
        ]);
    }
}
