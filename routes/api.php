<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Only login and register routes are public
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

// Protected group
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [ApiController::class, 'user']);
    Route::get('/profile', [ApiController::class, 'profile']);
    Route::get('/logout', [ApiController::class, 'logout']);
    Route::get('/refreshtoken', [ApiController::class, 'refreshToken']);
});