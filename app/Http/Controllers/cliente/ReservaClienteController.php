<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Carbon\Carbon;

class ReservaClienteController extends Controller
{
    public function minhasReservas()
    {
        $reservas = Reserva::where('usuario_id', auth()->id())
            ->with(['sala.imagens', 'sala.endereco'])
            ->orderBy('data_reserva', 'desc')
            ->get()
            ->groupBy(function ($reserva) {
                return $reserva->sala_id . '_' . $reserva->data_reserva;
            });

        return view('cliente.minhas-reservas', compact('reservas'));
    }

    public function verChave(Reserva $reserva)
    {
        return response()->json(['chave' => $reserva->chave_usada]);
    }

    public function cancelar(Reserva $reserva)
    {
        // seg — só o dono pode mexer
        if ($reserva->usuario_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Reserva não pertence a você.'], 403);
        }

        if (strtolower($reserva->status) !== 'pendente') {
            return response()->json(['success' => false, 'message' => 'Somente reservas pendentes podem ser canceladas.'], 422);
        }

        // marca como cancelada (não apaga — mantém histórico)
        $reserva->status = 'cancelada';
        $reserva->save();

        // se existir transação pendente, marca também
        \App\Models\Transacao::where('reference_id', 'reserva_'.$reserva->id)
            ->whereIn('status', ['pendente','iniciada','aguardando'])
            ->update(['status' => 'cancelada']);

        return response()->json(['success' => true]);
    }


}
