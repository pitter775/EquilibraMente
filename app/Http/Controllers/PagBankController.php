<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;
use Illuminate\Support\Facades\Http;
use App\Models\DebugLog;

class PagBankController extends Controller
{
    private $apiUrl;
    private $token;

    public function __construct()
    {
        $this->apiUrl = env('PAGBANK_URL', 'https://sandbox.api.pagseguro.com');
        $this->token = env('PAGBANK_TOKEN');
    }

    public function processarPagamento($dados)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->post("{$this->apiUrl}/checkouts", $dados);

        if ($response->failed()) {
            DebugLog::create(['mensagem' => 'Erro na resposta da API do PagBank:' . json_encode($response->body())]);

            return ["error" => "Erro ao gerar o link de pagamento"];
        }

        return ["checkout_url" => $response->json()['url'] ?? null];
    }

    public function callback(Request $request)
    {
        $data = $request->all();
    
        DebugLog::create(['mensagem' => 'Callback PagBank recebido: ' . json_encode($data)]);
    
        // Verifica se os dados necessários estão presentes
        if (!isset($data['id'], $data['reference_id'], $data['charges'][0]['status'])) {
            return response()->json(['error' => 'Dados incompletos'], 400);
        }
    
        // Pegando os dados principais
        $pagbank_order_id = $data['id'];
        $reference_id = $data['reference_id'];
        $status_pagamento = $data['charges'][0]['status'];
        $valor = $data['charges'][0]['amount']['value'] / 100; // Convertendo centavos para reais
        $detalhes_json = json_encode($data); // Guardando o JSON completo
    
        // Buscando o usuário e a sala baseados na referência
        $reserva_id = str_replace('reserva_', '', $reference_id);
        $reserva = \App\Models\Reserva::find($reserva_id);
    
        if (!$reserva) {
            return response()->json(['error' => 'Reserva não encontrada'], 404);
        }
    
        // Criando ou atualizando a transação
        $transacao = \App\Models\Transacao::updateOrCreate(
            ['pagbank_order_id' => $pagbank_order_id],
            [
                'usuario_id' => $reserva->usuario_id,
                'sala_id' => $reserva->sala_id,
                'reference_id' => $reference_id,
                'valor' => $valor,
                'status' => $status_pagamento === 'PAID' ? 'PAGA' : 'CANCELADA',
                'detalhes' => $detalhes_json,
            ]
        );
    
        // Atualizando o status da reserva
        $reserva->update([
            'status' => $status_pagamento === 'PAID' ? 'CONFIRMADA' : 'CANCELADA',
        ]);
    
        return response()->json(['message' => 'Transação salva com sucesso.']);
    }
    
    
    
}
