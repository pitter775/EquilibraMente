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
    
        $transacao = Transacao::where('pagbank_order_id', $data['order_id'])->firstOrFail();
        $transacao->update([
            'status' => $data['status'] === 'PAID' ? Transacao::STATUS_PAGA : Transacao::STATUS_CANCELADA,
        ]);
        
        // Atualizar status das reservas vinculadas, se necessário
        $transacao->reservas()->update([
            'status' => $data['status'] === 'PAID' ? 'CONFIRMADA' : 'CANCELADA',
        ]);
    
        return response()->json(['message' => 'Status atualizado com sucesso.']);
    }
    
}
