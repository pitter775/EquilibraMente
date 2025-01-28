<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;

class PagBankController extends Controller
{
    public function callback(Request $request)
    {
        $data = $request->all();
    
        // Identifique a reserva pela referência ou ID da transação
        $transacao = Transacao::where('pagbank_order_id', $data['order_id'])->firstOrFail();
    
        // Atualize o status da reserva associada
        $transacao->reservas()->update([
            'status' => $data['status'] === 'PAID' ? 'PAGA' : 'CANCELADA',
        ]);
    
        return response()->json(['message' => 'Status atualizado com sucesso.']);
    }
    
}
