<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sala;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Transacao;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {

        // Total de Reservas
        $totalReservas = Reserva::count();

        // Reservas Ativas e Concluídas
        $reservasAtivas = Reserva::where('status', 'ativa')->count();
        $reservasConcluidas = Reserva::where('status', 'concluida')->count();
        
        // Receita Estimada (com base no valor das reservas)
        $receitaEstimada = Reserva::join('salas', 'reservas.sala_id', '=', 'salas.id')
            ->selectRaw('SUM(TIMESTAMPDIFF(HOUR, reservas.hora_inicio, reservas.hora_fim) * salas.valor) as receita')
            ->value('receita');

        // Valor médio por reserva (total / número de reservas)
        $valorMedioReserva = ($totalReservas > 0) ? $receitaEstimada / $totalReservas : 0;

        // Taxa de Ocupação das Salas
        $taxaOcupacaoSalas = Sala::withCount(['reservas' => function ($query) {
            $query->where('status', 'ativa');
        }])
        ->get()
        ->map(function ($sala) {
            return [
                'nome' => $sala->nome,
                'taxa_ocupacao' => $sala->reservas_count
            ];
        });

        // Salas mais reservadas
        $salasMaisReservadas = Sala::withCount('reservas')
            ->orderByDesc('reservas_count')
            ->limit(5)
            ->get();

        // Gráfico de Reservas ao Longo do Tempo (reservas por dia do mês atual)
        $reservasPorDia = Reserva::whereMonth('data_reserva', Carbon::now()->month)
            ->selectRaw('DATE(data_reserva) as data, COUNT(*) as total')
            ->groupBy('data')
            ->orderBy('data')
            ->get();

        // Dados do dashboard
        $dados = [
            'totalReservas' => $totalReservas,
            'reservasAtivas' => $reservasAtivas,
            'reservasConcluidas' => $reservasConcluidas,
            'receitaEstimada' => $receitaEstimada,
            'valorMedioReserva' => $valorMedioReserva,
            'taxaOcupacaoSalas' => $taxaOcupacaoSalas,
            'salasMaisReservadas' => $salasMaisReservadas,
            'reservasPorDia' => $reservasPorDia,
        ];

        return view('admin.dashboard', compact('dados'));
    }
}
