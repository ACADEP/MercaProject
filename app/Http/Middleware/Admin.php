<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle($request, Closure $next)
    {
        //Revisar si esta autenticado
        if(!Auth::check())
        {
            return redirect('/');
        }

        if(Auth::user()->hasRole("Client")) {
            return redirect('/');
        }

        return $next($request);
    }
}