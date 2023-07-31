<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.welcome');
})->name('home');

Route::resource('categories',\App\Http\Controllers\CategoryController::class);
Route::resource('products',\App\Http\Controllers\ProductController::class);
Route::resource('users',\App\Http\Controllers\UserController::class);
Route::resource('categories_status',\App\Http\Controllers\CategoryStatusController::class);
Route::resource('products_status',\App\Http\Controllers\ProductStatusController::class);
Route::resource('users_status',\App\Http\Controllers\UserStatusController::class);
Route::get('posts',\App\Http\Livewire\Posts::class)->name('posts');
Route::get('comments',\App\Http\Livewire\Comments\Index::class)->name('comments');
Route::get('colors',\App\Http\Livewire\Colors\Index::class)->name('colors');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
