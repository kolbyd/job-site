<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Requires the user to be authenticated to access the route.
 */
class AuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            // User is a guest, redirect them to the login page
            flash()->error('You must be logged in to access this page.');
            return redirect()->guest(route('login'));
        }

        return $next($request);
    }
}
