<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            return redirect('/home'); // Redirect if user is already authenticated
        }

        return $next($request);
    }
}
