<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('key'))
        {
            return redirect('/logged/home')->with('status', 'Necesitas cerrar la sesión para acceder a esta vista');
        }

        return $next($request);
    }
}
