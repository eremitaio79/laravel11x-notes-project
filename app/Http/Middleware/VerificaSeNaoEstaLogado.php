<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificaSeNaoEstaLogado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado.
        if (session('username')) {
            // Se não estiver logado, redireciona para a página de login.
            return redirect('/');
        }

        // Se estiver logado, continua com a requisição.
        return $next($request);
    }
}
