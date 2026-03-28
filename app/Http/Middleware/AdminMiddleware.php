<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin area.');
        }

        $user = Auth::user();

        if (! $user->canAccessAdminPanel()) {
            abort(403, 'Access denied. Admin or staff privileges required.');
        }

        $routeName = $request->route()?->getName();

        if (! $user->canAccessAdminRoute($routeName)) {
            abort(403, 'Access denied. This area is restricted to administrators.');
        }

        return $next($request);
    }
}