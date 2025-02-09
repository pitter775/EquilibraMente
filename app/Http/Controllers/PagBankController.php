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
        // Captura todos os dados enviados pelo PagBank
        $data = $request->all();
    
        // Salva no log para depuração
        DebugLog::create(['mensagem' => 'Callback PagBank: ' . json_encode($data)]);
    
        // Verifica se o 'order_id' existe nos dados recebidos
        if (!isset($data['order_id'])) {
            return response()->json(['error' => 'order_id não encontrado'], 400);
        }
    
        // Busca a transação no banco
        $transacao = Transacao::where('pagbank_order_id', $data['order_id'])->first();
    
        if (!$transacao) {
            return response()->json(['error' => 'Transação não encontrada'], 404);
        }
    
        // Atualiza o status da transação
        $transacao->update([
            'status' => $data['status'] === 'PAID' ? 'PAGA' : 'CANCELADA',
            'detalhes' => json_encode($data), // Guarda o retorno completo para análise
        ]);
    
        // Atualiza o status da reserva vinculada (se existir)
        if ($transacao->reservas) {
            $transacao->reservas()->update([
                'status' => $data['status'] === 'PAID' ? 'CONFIRMADA' : 'CANCELADA',
            ]);
        }
    
        return response()->json(['message' => 'Status atualizado com sucesso.']);
    }
    
    
}
