<?php

namespace App\Modules\Students\Http\Controllers\Auth;

use App\Modules\Students\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('student.auth.confirm-password');
    }

    /**
     * Confirm the student's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('student')->validate([
            'email' => $request->user('student')->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('student.auth.password_confirmed_at', time());

        return redirect()->intended('/student');
    }
}
