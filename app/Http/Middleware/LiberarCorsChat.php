<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LiberarCorsChat
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // libera somente o arquivo chat-widget.js
        if ($request->is('js/chat-widget.js')) {
            $response->headers->set('Access-Control-Allow-Origin', '*'); // ou coloca o domínio exato se preferir
            $response->headers->set('Access-Control-Allow-Methods', 'GET, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
        }

        return $response;
    }
}
