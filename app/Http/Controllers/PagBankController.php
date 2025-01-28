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
            'status' => $data['status'] === 'PAID' ? Transacao::STATUS_PAGA : Transacao::STATUS_CANCELADA,
        ]);
        
        // Atualizar status das reservas vinculadas, se necessário
        $transacao->reservas()->update([
            'status' => $data['status'] === 'PAID' ? 'CONFIRMADA' : 'CANCELADA',
        ]);
    
        return response()->json(['message' => 'Status atualizado com sucesso.']);
    }
    
}
