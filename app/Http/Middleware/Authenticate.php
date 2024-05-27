<?php

namespace App\Http\Middleware;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $prefix = explode('.', $request->route()->getName())[0];
        if (in_array($prefix, ['api', 'cms'])) {
            throw new Exception('Unauthenticate', 401);
        }
        return route('login');
    }
}
