<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {// return Response("Chegamos no middleware");

        //Retorna o IP da rota dentro de server em REMOTE_ADDR
        $ip = $request->server->get('REMOTE_ADDR');
        //Retorna a rota em 'RequestUri'
        $rota = $request->getRequestUri();
        //Cria os atributos na tabela log_acesso no BD
        LogAcesso::create(['log' => "IP $ip requisitou a rota $rota"]);
        //Passa a requisição para o próximo middleware
        return $next($request);   
    }
}
