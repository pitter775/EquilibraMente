<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\DebugLog;

class AuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // Se o usuário está na página de detalhes de uma sala
        if ($request->has('sala_id')) {
            session(['voltar_para_sala' => route('site.sala.detalhes', ['id' => $request->input('sala_id')])]);

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
    
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'photo' => $googleUser->avatar,
                    'tipo_usuario' => 'cliente', // Certifique-se de que o cliente é definido como 'cliente'
                    'cadastro_completo' => false,
                    'password' => Hash::make('123'),
                ]
            );
    
            \Log::info('Usuário Google', [
                'id' => $user->id,
                'email' => $user->email,
                'tipo_usuario' => $user->tipo_usuario,
            ]);

            DebugLog::create([
                'mensagem' => 'Usuário Google - ID: ' . $user->id . ', Email: ' . $user->email . ', Tipo: ' . $user->tipo_usuario,
            ]);
    
            Auth::login($user);
    
            if (!$user->cadastro_completo) {
                return redirect()->route('completar.cadastro.form')->with('google_data', [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'photo' => $googleUser->avatar,
                ]);
            }
    
            $redirectUrl = session()->pull('voltar_para_sala', route('usuario.minhas.reservas'));

    
            return redirect($redirectUrl);
    
        } catch (\Exception $e) {
            \Log::error('Erro no login com Google: ' . $e->getMessage());
            DebugLog::create([
                'mensagem' => 'Erro no login com Google: : ' . $e->getMessage(),
            ]);
            return redirect()->route('site.index')->with('error', 'Falha no login com o Google.');
        }
    }
    
    
    
    
    
    
    
    
    


    
}

