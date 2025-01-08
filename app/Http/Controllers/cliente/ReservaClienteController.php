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
            ->with('sala') // Carrega informações relacionadas à sala
            ->orderBy('data_reserva', 'desc')
            ->get();
    
        return view('cliente.minhas-reservas', compact('reservas'));
    }
}
