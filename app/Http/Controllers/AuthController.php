<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // Se o usuário está na página de detalhes de uma sala
        if ($request->has('sala_id')) {
            session(['redirect_url' => route('site.sala.detalhes', ['id' => $request->input('sala_id')])]);
        } else {
            // Se o usuário está na home ou outra página
            session(['redirect_url' => url()->previous()]); // Salva a URL anterior
        }
    
        // Redireciona para o Google para autenticação
        return Socialite::driver('google')->redirect();
    }
    
    
    
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
    
            // Verifica se o usuário já existe ou cria um novo
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'photo' => $googleUser->avatar,
                    'cadastro_completo' => false,
                    'password' => Hash::make('123'),
                ]
            );
    
            // Faz o login do usuário
            Auth::login($user);
    
            // Verifica se o cadastro está completo
            if (!$user->cadastro_completo) {
                // Redireciona para a página de completar cadastro
                return redirect()->route('completar.cadastro.form')->with('google_data', [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'photo' => $googleUser->avatar,
                ]);
            }
    
            // Redireciona para a rota armazenada na sessão ou para a home
            $redirectUrl = session()->pull('redirect_url', route('site.index'));
            return redirect($redirectUrl);
    
        } catch (\Exception $e) {
            return redirect()->route('site.index')->with('error', 'Falha no login com o Google.');
        }
    }
    
    
    
    
    
    
    


    
}

