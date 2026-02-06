<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next)
    {
    // Check if the user is NOT verified
         if (auth()->check() && !auth()->user()->is_verified) {
           return redirect()->route('dashboard')->with('error', 'Your account is pending verification.');
    }

    return $next($request);
}
}
