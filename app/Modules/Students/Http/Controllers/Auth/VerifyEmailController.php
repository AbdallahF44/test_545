<?php

namespace App\Modules\Students\Http\Controllers\Auth;

use App\Modules\Students\Http\Controllers\Controller;
use App\Modules\Students\Http\Requests\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated student's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->intended('/student?verified=1');
        }

        if ($request->user('student')->markEmailAsVerified()) {
            event(new Verified($request->user('student')));
        }

        return redirect()->intended('/student?verified=1');
    }
}
