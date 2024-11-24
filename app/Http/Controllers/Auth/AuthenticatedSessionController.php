<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário
        $request->authenticate();
    
        // Regenera a sessão
        $request->session()->regenerate();
    
        // Redireciona baseado no tipo de usuário
        $user = Auth::user();
    
        if ($user->tipo_usuario === 'admin') {
            return redirect()->intended(route('admin.dashboard')); // Rota para a área administrativa
        }
    
        return redirect()->intended(route('cliente.reservas')); // Rota para a área do cliente
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
