<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $metodo_autenticacao, $perfil)
    {
        session_start();
        //Verifca se existe uma sessao com email e se o email não é vazio
        if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
            //Passa para o proximo middleware ou rota
            return $next($request);
        } else{
            return redirect()->route('site.login', ['erro' => 2]);
        }
    }
}
