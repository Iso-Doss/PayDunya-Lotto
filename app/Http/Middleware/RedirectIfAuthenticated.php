<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param string ...$guards
     * @return Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if ($guard == "customer" && Auth::guard($guard)->check()) {
                return redirect('/dashboard');
            }

            if ($guard == "administrator" && Auth::guard($guard)->check()) {
                return redirect('/admin/dashboard');
            }

            //if (Auth::guard($guard)->check()) {
            //    return redirect(RouteServiceProvider::HOME);
            //}

        }

        return $next($request);
    }
}
