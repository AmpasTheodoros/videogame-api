<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoGameController;

// Public auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Video game routes
    Route::get('/games', [VideoGameController::class, 'index']);
    Route::post('/games', [VideoGameController::class, 'store']);
    Route::get('/games/{id}', [VideoGameController::class, 'show']);
    Route::put('/games/{id}', [VideoGameController::class, 'update']);
    Route::delete('/games/{id}', [VideoGameController::class, 'destroy']);
});
