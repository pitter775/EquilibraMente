<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;

class PagBankController extends Controller
{
    public function callback(Request $request)
    {
        $data = $request->all();

        $transacao = Transacao::where('pagbank_order_id', $data['order_id'])->firstOrFail();
        $transacao->update([
            'status' => $data['status'], // Exemplo: PAID, PENDING, FAILED
            'detalhes' => json_encode($data),
        ]);

        return response()->json(['message' => 'Status atualizado com sucesso.']);
    }
}
