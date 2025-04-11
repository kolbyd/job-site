<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->guest()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to access this page.');
        }

        // Check if the user has the required role
        $user = auth()->user();
        if ($user->hasRole($role)) {
            return $next($request);
        }

        // If the user does not have the required role, redirect them
        return redirect()->route('index')
            ->with('error', 'You do not have permission to access this page.');
    }
}
