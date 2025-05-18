<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TesteUploadController extends Controller
{
    public function formulario()
    {
        return view('teste-upload');
    }

    public function upload(Request $request)
    {
        $arquivo = $request->file('arquivo');

        if (!$arquivo) {
            return back()->with('erro', 'Nenhum arquivo enviado');
        }

        $conteudo = file_get_contents($arquivo->getRealPath());

        $caminho = storage_path('logs/arquivo_teste.txt');
        $resultado = file_put_contents($caminho, $conteudo);

        if ($resultado !== false) {
            $conteudoLido = file_get_contents($caminho);
            return "<pre>Arquivo gravado com sucesso em: $caminho\n\nConteúdo:\n$conteudoLido</pre>";
        } else {
            return "Erro ao gravar o arquivo.";
        }
    }
}
