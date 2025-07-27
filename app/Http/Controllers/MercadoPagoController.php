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

class MercadoPagoController extends Controller
{
    public function webhook(Request $request)
    {
        $body = json_decode($request->getContent(), true);

        Log::info('🔔 Webhook Mercado Pago', $body);

        if (isset($body['type']) && $body['type'] === 'payment') {
            $paymentId = $body['data']['id'];

            if ($paymentId && is_numeric($paymentId)) {
                $response = Http::withToken(config('services.mercadopago.access_token'))
                                ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
                                ->json();

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
