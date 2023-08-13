<?php

namespace App\Modules\Students\Http\Controllers;

use App\Modules\Students\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the student's profile form.
     */
    public function edit(Request $request): View
    {
        return view('student.profile.edit', [
            'user' => $request->user('student'),
        ]);
    }

    /**
     * Update the student's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('student')->fill($request->validated());

        if ($request->user('student')->isDirty('email')) {
            $request->user('student')->email_verified_at = null;
        }

        $request->user('student')->save();

        return Redirect::route('student.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the student's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password:student'],
        ]);

        $student = $request->user('student');

        Auth::guard('student')->logout();

        $student->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/student');
    }
}
