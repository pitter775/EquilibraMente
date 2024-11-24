<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;

class SiteController extends Controller
{
    public function index()
    {
        $salas = Sala::with('imagens')->get();

        return view('site.index', compact('salas'));
    }
    

    public function detalhes($id)
    {
        // Busca a sala pelo ID, ou retorna 404 se não encontrada
        $sala = Sala::with('conveniencias')->findOrFail($id);

        // Renderiza uma view para exibir os detalhes da sala
        return view('site.detalhes', compact('sala'));
    }
}
