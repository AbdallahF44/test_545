<?php

namespace App\Modules\Students\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

/**
 * @see \Illuminate\Auth\Middleware\EnsureEmailIsVerified
 */
class EnsureStudentEmailIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ?string $redirectToRoute = null): Response
    {
        if (! $request->user('student')
            || ($request->user('student') instanceof MustVerifyEmail
                && ! $request->user('student')->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route($redirectToRoute ?: 'student.verification.notice');
        }

        return $next($request);
    }
}
