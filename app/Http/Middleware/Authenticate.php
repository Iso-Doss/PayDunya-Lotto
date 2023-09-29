<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $uris = explode('/', $request->route()->uri());
        $uri = (empty($uris[0])) ? '' : $uris[0];

        $route = route('customer.auth.sign-in');

        if ($request->expectsJson()) {
            $route = null;
        } else {
            if ('CUSTOMER' === $request->user()?->profile || 'CUSTOMER' === strtoupper($uri)) {
                $route = route('customer.auth.sign-in');
            } else if ('ADMINISTRATOR' === $request->user()?->profile || 'ADMINISTRATOR' === strtoupper($uri)) {
                $route = route('administrator.auth.sign-in');
            }
        }
        return $route;
        //return $request->expectsJson() ? null : route('login');
    }
}
