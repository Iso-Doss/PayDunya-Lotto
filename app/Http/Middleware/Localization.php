<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request The request.
     * @param Closure $next The next.
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ( \Session::has('lang')) {
            // Récupération de la 'lang' dans Session et activation
            \App::setLocale(\Session::get('lang'));
        }

        return $next($request);
    }
}
