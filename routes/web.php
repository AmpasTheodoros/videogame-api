<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;

// Guest routes: Only accessible when not logged in
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
});



// Authenticated routes: Only accessible when logged in
Route::middleware('auth')->group(function () {
    Route::get('/games/{videoGameId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/games/{videoGameId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Game routes
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.destroy');
});

Route::get('/', function () {
    return view('welcome');
});
