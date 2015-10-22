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
        // todoImplementar validação
        if(Auth::user()->hasRule($request->route()->getName())){
            return response('Você não tem permissão para executar essa ação!', 401);
        }
        return $next($request);
    }
}
