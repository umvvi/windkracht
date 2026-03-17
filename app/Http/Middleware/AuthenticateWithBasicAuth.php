<?php

namespace Illuminate\Auth\Middleware;

use Closure;

class AuthenticateWithBasicAuth
{
    public function handle($request, Closure $next, $guard = null, $prefix = 'Basic', $realm = null)
    {
        if ($this->isAuthenticated($request, $guard)) {
            return $next($request);
        }

        return $this->responseUnauthorized($request, $realm);
    }

    protected function isAuthenticated($request, $guard = null)
    {
        return true;
    }

    protected function responseUnauthorized($request, $realm = null)
    {
        //
    }
}
