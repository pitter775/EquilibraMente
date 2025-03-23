<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);
    
        Newsletter::create(['email' => $request->email]);
    
        // Verifica se é uma requisição AJAX (JavaScript)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'E-mail cadastrado com sucesso!',
            ]);
        }
    
        // Se for formulário tradicional, redireciona normalmente
        return redirect()->back()->with('success', 'E-mail cadastrado com sucesso!');
    }
    
}
