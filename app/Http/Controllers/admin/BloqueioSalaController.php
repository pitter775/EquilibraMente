<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BloqueioSala;
use App\Models\Sala;
use Illuminate\Http\Request;

class BloqueioSalaController extends Controller
{
    public function store(Request $request, Sala $sala)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:dia_inteiro,intervalo',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fim' => 'nullable|date_format:H:i|after:hora_inicio',
            'motivo' => 'nullable|string|max:2000',
        ]);

        if ($validated['tipo'] === 'dia_inteiro') {
            $validated['hora_inicio'] = null;
            $validated['hora_fim'] = null;
        } else {
            if (empty($validated['hora_inicio']) || empty($validated['hora_fim'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Informe hora inicial e final para bloqueios por intervalo.',
                ], 422);
            }
        }

        $bloqueio = $sala->bloqueios()->create([
            ...$validated,
            'ativo' => true,
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bloqueio cadastrado com sucesso.',
            'data' => $bloqueio->fresh('criador'),
        ]);
    }

    public function destroy(BloqueioSala $bloqueio)
    {
        $bloqueio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bloqueio removido com sucesso.',
        ]);
    }
}
