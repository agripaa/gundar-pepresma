<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Cek apakah user yang sedang login adalah admin
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You do not have admin access.');
    }
}
