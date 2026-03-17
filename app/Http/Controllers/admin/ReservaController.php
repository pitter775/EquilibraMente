<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Reserva;
use App\Models\BloqueioSala;
use Carbon\Carbon;
use App\Models\Transacao;
use Illuminate\Support\Facades\Log;

class ReservaController extends Controller
{
    public function index()
    {
        return view('admin.reservas.index');
    }

    public function store(Request $request)
    {
        // Validação inicial
        $validated = $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'horarios' => 'required|array|min:1',  // Verifica se existe ao menos um horário
            'horarios.*.data_reserva' => 'required|date',
            'horarios.*.hora_inicio' => 'required|date_format:H:i',
            'horarios.*.hora_fim' => 'required|date_format:H:i|after:horarios.*.hora_inicio',
        ]);

        $sala = Sala::findOrFail($validated['sala_id']);
        $conflitos = [];

        // Verifica conflitos para todos os horários antes de criar reservas
        foreach ($validated['horarios'] as $horario) {
            if ($this->existeBloqueioParaPeriodo($sala->id, $horario['data_reserva'], $horario['hora_inicio'], $horario['hora_fim'])) {
                $conflitos[] = "{$horario['data_reserva']} - {$horario['hora_inicio']} às {$horario['hora_fim']} (bloqueado manualmente)";
                continue;
            }

            $conflict = $sala->reservas()
                ->where('data_reserva', $horario['data_reserva'])
                ->whereIn('status', ['CONFIRMADA', 'PENDENTE']) // aqui considera os dois
                ->where(function ($query) use ($horario) {
                    $query->where(function ($q) use ($horario) {
                        $q->where('hora_inicio', '<', $horario['hora_fim'])
                        ->where('hora_fim', '>', $horario['hora_inicio']);
                    });
                })
                ->exists();

            if ($conflict) {
                $conflitos[] = "{$horario['data_reserva']} - {$horario['hora_inicio']} às {$horario['hora_fim']}";
            }
        }

        // Se houver conflitos, retorna erro e lista os horários conflitantes
        if (!empty($conflitos)) {
            return response()->json([
                'success' => false,
                'message' => 'A sala já está reservada nos seguintes horários: ' . implode(', ', $conflitos)
            ]);
        }

        // Se não houver conflitos, cria as reservas
        $reservasCriadas = [];
        foreach ($validated['horarios'] as $horario) {
            $reserva = $sala->reservas()->create([
                'data_reserva' => $horario['data_reserva'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fim' => $horario['hora_fim'],
                'usuario_id' => auth()->id() ?? 1,
                'status' => 'CONFIRMADA',   // Usa o ID do usuário logado
            ]);
            $reservasCriadas[] = $reserva;
        }

        return response()->json([
            'success' => true,
            'reservas' => $reservasCriadas
        ]);
    }

    public function listar()
    {
        try {
            $reservas = Reserva::query()
                ->select([
                    'id',
                    'usuario_id',
                    'sala_id',
                    'data_reserva',
                    'hora_inicio',
                    'hora_fim',
                    'status',
                    'created_at',
                ])
                ->with([
                    'usuario:id,name,email,telefone,photo',
                    'sala:id,nome,valor',
                    'sala.imagens' => function ($query) {
                        $query
                            ->select(['id', 'sala_id', 'imagem_base64', 'principal'])
                            ->where('principal', true);
                    },
                    'sala.endereco:id,enderecavel_id,enderecavel_type,rua,numero,bairro,cidade,estado',
                ])
                ->latest('data_reserva')
                ->latest('hora_inicio')
                ->get();

            return response()->json($reservas);
        } catch (\Throwable $e) {
            Log::error('Falha ao listar reservas para DataTable.', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Nao foi possivel carregar a lista de reservas.',
            ], 500);
        }
    }


    public function listarReservas($sala_id)
    {
        $reservas = Reserva::where('sala_id', $sala_id)->get(['data_reserva', 'hora_inicio', 'hora_fim']);

        $eventos = $reservas->map(function ($reserva) {
            return [
                'title' => 'Reservado',
                'start' => $reserva->data_reserva . 'T' . $reserva->hora_inicio,
                'end' => $reserva->data_reserva . 'T' . $reserva->hora_fim,
                'color' => '#ff5e5e',
            ];
        });

        return response()->json($eventos);
    }

    // Novo método para listar horários disponíveis
    public function horariosDisponiveis($sala_id, $data_reserva)
    {
        // --- faxina on-demand: zera pendentes > 30min desta sala ---
        $limite = now()->subMinutes(30);

        // pega ids pendentes antigos
        $ids = \App\Models\Reserva::where('sala_id', $sala_id)
            ->whereIn('status', ['pendente','PENDENTE'])
            ->where('created_at', '<', $limite) // base por criação da reserva
            ->pluck('id');

        if ($ids->isNotEmpty()) {
            // cancela reservas (padroniza status)
            \App\Models\Reserva::whereIn('id', $ids)->update([
                'status' => 'CANCELADA',
                'updated_at' => now(),
            ]);

            // marca transações vinculadas como canceladas (cobre 2 formatos de reference_id)
            Transacao::whereIn('reference_id', $ids->map(fn ($id) => (string)$id)->all())
                ->whereIn('status', ['pendente','iniciada','aguardando','pending'])
                ->update(['status' => 'cancelada', 'updated_at' => now()]);

            Transacao::whereIn('reference_id', $ids->map(fn ($id) => 'reserva_'.$id)->all())
                ->whereIn('status', ['pendente','iniciada','aguardando','pending'])
                ->update(['status' => 'cancelada', 'updated_at' => now()]);
        }
        // --- fim faxina ---
        $reservas = Reserva::where('sala_id', $sala_id)
            ->where('data_reserva', $data_reserva)
            ->whereIn('status', ['CONFIRMADA', 'PENDENTE']) // <-- só considera essas
            ->get(['hora_inicio', 'hora_fim']);

        $bloqueios = $this->buscarBloqueiosAtivos($sala_id, $data_reserva);
        $horariosPossiveis = $this->gerarHorariosPossiveis();

        $horarios = $horariosPossiveis->map(function ($horario) use ($reservas, $bloqueios) {
            $bloqueio = $bloqueios->first(fn ($item) => $this->horarioBloqueado($horario, $item));
            if ($bloqueio) {
                return [
                    ...$horario,
                    'status' => 'bloqueado',
                    'mensagem' => $bloqueio->motivo ?: 'Horário bloqueado pela administração.',
                ];
            }

            $reserva = $reservas->first(fn ($item) => $this->horarioConflita($horario, $item));
            if ($reserva) {
                return [
                    ...$horario,
                    'status' => 'reservado',
                    'mensagem' => 'Este horário já foi reservado.',
                ];
            }

            return [
                ...$horario,
                'status' => 'disponivel',
                'mensagem' => 'Horário disponível para reserva.',
            ];
        });

        return response()->json([
            'horarios' => $horarios->values(),
        ]);
    }


    private function gerarHorariosPossiveis()
    {
        $horarios = collect();
        $inicio = Carbon::createFromTime(8, 0); // Horário inicial
        $fim = Carbon::createFromTime(20, 0);   // Horário final

        while ($inicio->lessThan($fim)) {
            $horarios->push([
                'inicio' => $inicio->format('H:i'),
                'fim' => $inicio->copy()->addHour()->format('H:i')
            ]);
            $inicio->addHour();
        }

        return $horarios;
    }

    private function horarioConflita($horario, $reserva)
    {
        return ($horario['inicio'] < $reserva->hora_fim && $horario['fim'] > $reserva->hora_inicio);
    }

    private function buscarBloqueiosAtivos(int $salaId, string $dataReserva)
    {
        return BloqueioSala::query()
            ->where('sala_id', $salaId)
            ->where('ativo', true)
            ->whereDate('data_inicio', '<=', $dataReserva)
            ->whereDate('data_fim', '>=', $dataReserva)
            ->get();
    }

    private function existeBloqueioParaPeriodo(int $salaId, string $dataReserva, string $horaInicio, string $horaFim): bool
    {
        $horario = [
            'inicio' => substr($horaInicio, 0, 5),
            'fim' => substr($horaFim, 0, 5),
        ];

        foreach ($this->buscarBloqueiosAtivos($salaId, $dataReserva) as $bloqueio) {
            if ($this->horarioBloqueado($horario, $bloqueio)) {
                return true;
            }
        }

        return false;
    }

    private function horarioBloqueado(array $horario, BloqueioSala $bloqueio): bool
    {
        if ($bloqueio->tipo === 'dia_inteiro') {
            return true;
        }

        if (!$bloqueio->hora_inicio || !$bloqueio->hora_fim) {
            return true;
        }

        $inicioBloqueio = substr($bloqueio->hora_inicio, 0, 5);
        $fimBloqueio = substr($bloqueio->hora_fim, 0, 5);

        return $horario['inicio'] < $fimBloqueio && $horario['fim'] > $inicioBloqueio;
    }







}
