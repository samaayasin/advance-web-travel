<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'getCurrentUser']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/user', [UserController::class, 'update']);

    Route::put('/user/password', [UserController::class, 'updatePassword']);
});

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
