<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\CategoryStatusController;

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
Route::get('/products/{product}/images/{imageId}/edit', [ProductController::class, 'editImage'])->name('products.editImage');
Route::put('/products/{product}/images/{imageId}/edit', [ProductController::class, 'updateImage'])->name('products.updateImage');
Route::get('/products/{product}/images/{imageId}/delete', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
Route::get('/productsPDF/{product}', [ProductController::class, 'getPDF'])->name('products.getPDF');

Route::resource('categories', CategoryController::class)->missing(function () {
    return redirect()->route('categories.index');
});
Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
Route::resource('categories_status', CategoryStatusController::class);
Route::resource('products_status', ProductStatusController::class);
Route::resource('users_status', UserStatusController::class);
Route::get('posts', \App\Http\Livewire\Posts::class)->name('posts');
Route::get('comments', \App\Http\Livewire\Comments\Index::class)->name('comments');
Route::get('colors', \App\Http\Livewire\Colors\Index::class)->name('colors');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::fallback(function () {
    // return view('welcome');
    return redirect()->back();
});
