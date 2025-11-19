<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// User homepage
Route::get('/', function () {
    return view('user.home');
})->name('home');

// Admin dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// AUTH ROUTES (login, register, logout)
require __DIR__.'/auth.php';
