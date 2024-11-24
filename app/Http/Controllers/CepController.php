<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function buscarCep($cep)
    {
        // Faz a requisição para a API do viacep
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        
        return $response->json();
    }
}
