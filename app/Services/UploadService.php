<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadService
{
    protected string $pastaBase = 'logs/uploads'; // subpasta dentro de logs

    public function salvarArquivo(UploadedFile $arquivo, ?string $nomePersonalizado = null): string|false
    {
        $extensao = $arquivo->getClientOriginalExtension();
        $nome = $nomePersonalizado ?? Str::uuid() . '.' . $extensao;

        $caminho = storage_path($this->pastaBase . '/' . $nome);

        if (!file_exists(dirname($caminho))) {
            mkdir(dirname($caminho), 0775, true);
        }

        $conteudo = file_get_contents($arquivo->getRealPath());
        $resultado = file_put_contents($caminho, $conteudo);

        return $resultado !== false ? $nome : false;
    }

    public function lerArquivo(string $nome): string|false
    {
        $caminho = storage_path($this->pastaBase . '/' . $nome);
        return file_exists($caminho) ? file_get_contents($caminho) : false;
    }

    public function deletarArquivo(string $nome): bool
    {
        $caminho = storage_path($this->pastaBase . '/' . $nome);
        return file_exists($caminho) ? unlink($caminho) : false;
    }

    public function caminhoCompleto(string $nome): string
    {
        return storage_path($this->pastaBase . '/' . $nome);
    }

    public function mime(string $nome): string
    {
        return mime_content_type($this->caminhoCompleto($nome));
    }
}
