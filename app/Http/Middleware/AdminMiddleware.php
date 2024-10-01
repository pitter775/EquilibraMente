<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e é admin
        if (Auth::check() && Auth::user()->tipo_usuario === 'admin') {
            return $next($request);
        }

        // Se não for admin, redireciona para a página inicial
        return redirect('/');
    }
}
