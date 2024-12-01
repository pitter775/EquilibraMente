<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Reserva;
use Carbon\Carbon;

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
            $conflict = $sala->reservas()
                ->where('data_reserva', $horario['data_reserva'])
                ->where(function($query) use ($horario) {
                    $query->whereBetween('hora_inicio', [$horario['hora_inicio'], $horario['hora_fim']])
                          ->orWhereBetween('hora_fim', [$horario['hora_inicio'], $horario['hora_fim']]);
                })->exists();
    
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
                'usuario_id' => auth()->id() ?? 1,  // Usa o ID do usuário logado
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
        // Carrega as reservas com os dados de 'usuario' e 'sala'
        $reservas = Reserva::with(['usuario', 'sala'])->get();

        return response()->json($reservas);
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
        $reservas = Reserva::where('sala_id', $sala_id)
            ->where('data_reserva', $data_reserva)
            ->get(['hora_inicio', 'hora_fim']);

        $horariosPossiveis = $this->gerarHorariosPossiveis();
        
        // Filtra horários disponíveis removendo os já reservados
        $horariosDisponiveis = $horariosPossiveis->filter(function ($horario) use ($reservas) {
            foreach ($reservas as $reserva) {
                if ($this->horarioConflita($horario, $reserva)) {
                    return false;
                }
            }
            return true;
        });

        return response()->json(['horarios' => $horariosDisponiveis->values()]);
    }

    private function gerarHorariosPossiveis()
    {
        $horarios = collect();
        $inicio = Carbon::createFromTime(8, 0); // Horário inicial
        $fim = Carbon::createFromTime(18, 0);   // Horário final

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





    

}
