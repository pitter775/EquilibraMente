<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividade;

class AtividadeController extends Controller
{
    public function index()
    {
        return Atividade::latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fim' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $atividade = Atividade::create($request->only([
            'descricao',
            'hora_inicio',
            'hora_fim',
            'id_usuario'
        ]));

        return response()->json([
            'success' => true,
            'mensagem' => 'Atividade cadastrada com sucesso!',
            'data' => [$atividade] // retorna em array pra evitar erro no foreach
        ]);
    }


    public function show($id)
    {
        return Atividade::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $atividade = Atividade::findOrFail($id);
        $atividade->update($request->only(['descricao', 'hora_inicio', 'hora_fim']));
        return $atividade;
    }

    public function destroy($id)
    {
        $atividade = Atividade::findOrFail($id);
        $atividade->delete();
        return response()->json(['mensagem' => 'Removido com sucesso']);
    }
}
