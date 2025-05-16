<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContratoController extends Controller
{
    public function index()
    {
        $contrato = Contract::latest()->first();
        return view('admin.contratos.editar', compact('contrato'));
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'versao' => 'required|string',
            'conteudo' => 'required|string',
        ]);

        Contract::create([
            'versao' => $request->input('versao'),
            'conteudo' => $request->input('conteudo'),
        ]);

        return redirect()->route('admin.contrato.index')->with('success', 'Contrato salvo com sucesso!');
    }
}
