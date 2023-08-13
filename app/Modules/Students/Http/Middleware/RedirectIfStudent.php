<?php

namespace App\Modules\Students\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @see \Http\Middleware\RedirectIfAuthenticated
 */
class RedirectIfStudent
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $guard = 'student'): Response
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/student');
        }

        return $next($request);
    }
}
