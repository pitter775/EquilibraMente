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
                        $reserva = Reserva::find($reservaId);

                        if (!$reserva) {
                            DebugLog::create(['mensagem' => '⚠️ Reserva não encontrada: ' . $reservaId]);
                            return response()->json(['mensagem' => 'Reserva não encontrada'], 200);
                        }

                        Transacao::updateOrCreate(
                            ['external_id' => $response['id']],
                            [
                                'reference_id' => $reserva->id,
                                'usuario_id' => $reserva->usuario_id,
                                'sala_id' => $reserva->sala_id,
                                'status' => $response['status'],
                                'valor' => $response['transaction_amount'],
                                'pagbank_order_id' => $response['order']['id'] ?? null,
                                'detalhes' => json_encode($response),
                            ]
                        );

                        DebugLog::create(['mensagem' => '✅ Transação registrada com sucesso para reserva ' . $reserva->id]);
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
