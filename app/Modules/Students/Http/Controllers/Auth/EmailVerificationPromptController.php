<?php

namespace App\Modules\Students\Http\Controllers\Auth;

use App\Modules\Students\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('student')->hasVerifiedEmail()
                    ? redirect()->intended('/student')
                    : view('student.auth.verify-email');
    }
}
