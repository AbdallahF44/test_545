<?php

namespace App\Modules\Students\Http\Controllers\Auth;

use App\Modules\Students\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->intended('/student');
        }

        $request->user('student')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
