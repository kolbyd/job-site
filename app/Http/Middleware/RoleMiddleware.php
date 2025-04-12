<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Requires the user to be in a certain role to access the route.
 */
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
            flash()->error('You must be logged in to access this page.');
            return redirect()->route('login');
        }

        // Check if the user has the required role.
        // Admins get all access.
        $user = auth()->user();
        if ($user->isAdmin() || $user->hasRole($role)) {
            return $next($request);
        }

        // If the user does not have the required role, redirect them
        flash()->error('You do not have permission to access this page.');
        return redirect()->route('index');
    }
}
