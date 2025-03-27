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
        $agora = now();
        $inicio = \Carbon\Carbon::parse($reserva->data_reserva . ' ' . $reserva->hora_inicio)->subMinutes(30);
        $fim = \Carbon\Carbon::parse($reserva->data_reserva . ' ' . $reserva->hora_fim);

        if ($reserva->usuario_id !== auth()->id()) {
            return response()->json(['error' => 'Acesso negado.'], 403);
        }

        if ($agora->between($inicio, $fim)) {
            return response()->json(['chave' => $reserva->chave_usada]);
        }

        return response()->json(['error' => 'A chave ainda não está disponível.'], 403);
    }

}
