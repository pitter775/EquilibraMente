<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Sala;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $hoje = Carbon::today();
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        $salas = Sala::select('id', 'nome', 'status', 'valor')->orderBy('nome')->get();
        $reservas = Reserva::with([
            'sala:id,nome,valor',
            'usuario:id,name,email,telefone',
        ])
            ->orderBy('data_reserva')
            ->orderBy('hora_inicio')
            ->get()
            ->map(function ($reserva) {
                $reserva->status_normalizado = $this->normalizarStatus($reserva->status);
                $reserva->data_carbono = Carbon::parse($reserva->data_reserva);
                $reserva->inicio_carbono = Carbon::parse($reserva->data_reserva . ' ' . $reserva->hora_inicio);
                $reserva->fim_carbono = Carbon::parse($reserva->data_reserva . ' ' . $reserva->hora_fim);
                $reserva->duracao_horas = $this->calcularDuracaoHoras($reserva->hora_inicio, $reserva->hora_fim);
                $reserva->valor_total = round(($reserva->sala->valor ?? 0) * $reserva->duracao_horas, 2);

                return $reserva;
            });

        $reservasValidas = $reservas->filter(fn ($reserva) => $reserva->status_normalizado !== 'cancelada')->values();
        $reservasMes = $reservasValidas->filter(
            fn ($reserva) => $reserva->data_carbono->between($inicioMes, $fimMes, true)
        );

        $statusDistribuicao = [
            'confirmada' => $reservas->where('status_normalizado', 'confirmada')->count(),
            'pendente' => $reservas->where('status_normalizado', 'pendente')->count(),
            'cancelada' => $reservas->where('status_normalizado', 'cancelada')->count(),
        ];

        $ultimos20Dias = collect(range(19, 0))->reverse()->map(function ($offset) {
            return Carbon::today()->subDays($offset);
        })->push(Carbon::today());

        $ocupacaoUltimos20Dias = $ultimos20Dias->map(function ($dia) use ($reservasValidas) {
            $horasReservadas = $reservasValidas
                ->filter(fn ($reserva) => $reserva->data_carbono->isSameDay($dia))
                ->sum('duracao_horas');

            return [
                'label' => $dia->format('d/m'),
                'horas' => round($horasReservadas, 1),
            ];
        })->values();

        $salasMaisReservadas = $salas->map(function ($sala) use ($reservasValidas) {
            $reservasSala = $reservasValidas->where('sala_id', $sala->id);

            return [
                'nome' => $sala->nome,
                'total' => $reservasSala->count(),
                'receita' => round($reservasSala->sum('valor_total'), 2),
            ];
        })->sortByDesc('total')->values();

        $diasDoMes = collect(range(1, $fimMes->day))->map(function ($dia) use ($inicioMes, $reservasMes) {
            $data = $inicioMes->copy()->day($dia);
            $reservasDia = $reservasMes->filter(fn ($reserva) => $reserva->data_carbono->isSameDay($data));

            return [
                'label' => $data->format('d/m'),
                'total' => $reservasDia->count(),
            ];
        });

        $ultimosSeisMeses = collect(range(5, 0))->reverse()->map(function ($offset) {
            return Carbon::now()->startOfMonth()->subMonths($offset);
        })->push(Carbon::now()->startOfMonth());

        $evolucaoMensal = $ultimosSeisMeses->map(function ($mes) use ($reservasValidas) {
            $reservasMesAtual = $reservasValidas->filter(function ($reserva) use ($mes) {
                return $reserva->data_carbono->year === $mes->year && $reserva->data_carbono->month === $mes->month;
            });

            return [
                'label' => ucfirst($mes->translatedFormat('M/y')),
                'reservas' => $reservasMesAtual->count(),
                'receita' => round(
                    $reservasMesAtual
                        ->where('status_normalizado', 'confirmada')
                        ->sum('valor_total'),
                    2
                ),
            ];
        });

        $proximasReservas = $reservasValidas
            ->filter(fn ($reserva) => $reserva->fim_carbono->greaterThanOrEqualTo(now()))
            ->sortBy(fn ($reserva) => $reserva->inicio_carbono->timestamp)
            ->take(6)
            ->values();

        $receitaConfirmadaMes = round(
            $reservasMes
                ->where('status_normalizado', 'confirmada')
                ->sum('valor_total'),
            2
        );

        $ticketMedioConfirmado = $reservas->where('status_normalizado', 'confirmada')->count() > 0
            ? round($reservas->where('status_normalizado', 'confirmada')->sum('valor_total') / $reservas->where('status_normalizado', 'confirmada')->count(), 2)
            : 0;

        $dados = [
            'resumo' => [
                'reservasHoje' => $reservasValidas->filter(fn ($reserva) => $reserva->data_carbono->isSameDay($hoje))->count(),
                'reservasMes' => $reservasMes->count(),
                'pendentes' => $statusDistribuicao['pendente'],
                'receitaConfirmadaMes' => $receitaConfirmadaMes,
                'ticketMedio' => $ticketMedioConfirmado,
                'salasDisponiveis' => $salas->where('status', 'disponivel')->count(),
                'clientes' => User::where('tipo_usuario', 'cliente')->count(),
                'canceladasMes' => $reservas
                    ->where('status_normalizado', 'cancelada')
                    ->filter(fn ($reserva) => $reserva->data_carbono->between($inicioMes, $fimMes, true))
                    ->count(),
            ],
            'statusDistribuicao' => $statusDistribuicao,
            'salasMaisReservadas' => $salasMaisReservadas,
            'ocupacaoUltimos20Dias' => $ocupacaoUltimos20Dias,
            'reservasPorDia' => $diasDoMes,
            'evolucaoMensal' => $evolucaoMensal,
            'proximasReservas' => $proximasReservas,
        ];

        return view('admin.dashboard', compact('dados'));
    }

    public function analitico()
    {
        return view('admin.analitico');
    }

    private function normalizarStatus(?string $status): string
    {
        $status = strtoupper(trim((string) $status));

        return match (true) {
            in_array($status, ['CONFIRMADA', 'ATIVA', 'RESERVADO', 'CONCLUIDA'], true) => 'confirmada',
            in_array($status, ['PENDENTE', 'PENDING'], true) => 'pendente',
            in_array($status, ['CANCELADA', 'CANCELLED', 'REJECTED', 'REFUNDED', 'CHARGED_BACK'], true) => 'cancelada',
            default => 'pendente',
        };
    }

    private function calcularDuracaoHoras(?string $horaInicio, ?string $horaFim): float
    {
        if (!$horaInicio || !$horaFim) {
            return 0;
        }

        $inicio = Carbon::createFromFormat('H:i:s', strlen($horaInicio) === 5 ? $horaInicio . ':00' : $horaInicio);
        $fim = Carbon::createFromFormat('H:i:s', strlen($horaFim) === 5 ? $horaFim . ':00' : $horaFim);

        if ($fim->lessThanOrEqualTo($inicio)) {
            return 0;
        }

        return round($inicio->diffInMinutes($fim) / 60, 2);
    }
}
