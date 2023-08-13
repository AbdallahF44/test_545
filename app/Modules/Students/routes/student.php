<?php

use App\Modules\Students\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'student.auth', 'student.verified'])->get('/student', function () {
    return view('student.dashboard');
})->name('student.dashboard');

Route::group(['as' => 'student.', 'prefix' => '/student', 'middleware' => ['web', 'student.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
