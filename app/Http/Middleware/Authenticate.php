<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('login'); // Redireciona para login apenas em requisições normais
        }
    
        return response()->json(['error' => 'Usuário não autenticado.'], 401); // Para requisições AJAX
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            abort(response()->json(['error' => 'Usuário não autenticado.'], 401));
        }

        parent::unauthenticated($request, $guards);
    }
}
