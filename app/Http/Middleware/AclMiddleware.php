<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AclMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        /*
         * Validar se o usuário possui acesso a rota requisitada
         */
        if(Auth::user()->hasRule($request->route()->getName())){
            return $next($request);
        }else{
            return response('Você não tem permissão para executar essa ação!', 401);
        }
    }
}
