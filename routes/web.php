<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware AUTH
Route::middleware('auth')->group(function () {

    // PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ADMIN ROUTES
    Route::prefix('admin')->name('admin.')->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // CRUD User (manual, bukan resource)
        Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminController::class, 'store'])->name('users.store');

        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');

        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

        // PRODUCTS (resource)
        Route::resource('products', ProductController::class);
    });
});

require __DIR__.'/auth.php';
