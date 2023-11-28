<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Response;

class Authenticate extends Middleware
{
    /**
     * @param Request $request
     * @var $request
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ? string
    {
        if ($request->expectsJson()) {
            return null; // Return null to indicate no redirect for JSON requests
        } else {

            return new AuthenticationException ();
        }
    }


}