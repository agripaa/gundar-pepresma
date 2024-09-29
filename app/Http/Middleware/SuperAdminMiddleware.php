<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'superadmin') {
            return $next($request); // Allow access if user is superadmin
        }

        return redirect('/home'); // Otherwise redirect
    }
}
