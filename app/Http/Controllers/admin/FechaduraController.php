<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Fechadura;
use App\Models\Sala;
use Illuminate\Http\Request;
use App\Models\Reserva;

class FechaduraController extends Controller
{
    public function index()
    {
        $salas = Sala::with(['fechadura', 'imagens'])->get();
    
        $chavesBloqueadas = Reserva::whereNotNull('chave_usada')
        ->where('status', 'ativa') // só pega reserva ativa
        ->pluck('chave_usada')
        ->toArray();
    
        return view('admin.fechadura', compact('salas', 'chavesBloqueadas'));
    }

    public function atualizar(Request $request, Sala $sala)
    {
        $request->validate([
            'chaves' => 'array|max:4',
            'chaves.*' => 'nullable|string|max:12'
        ]);

        $dados = [
            'chaves' => array_filter($request->chaves ?? [], fn($v) => !is_null($v))
        ];

        // cria ou atualiza a fechadura da sala
        $sala->fechadura()->updateOrCreate(
            ['sala_id' => $sala->id],
            $dados
        );

        return redirect()->back()->with('success', 'Fechadura atualizada com sucesso!');
    }
}
