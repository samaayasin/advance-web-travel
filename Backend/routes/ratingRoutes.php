<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::middleware('auth:sanctum')->group(function () {

  Route::post('/reviews', [ReviewController::class, 'store']);

  Route::get('/services/{service}/reviews', [ReviewController::class, 'index']);

  Route::get('/reviews/{review}', [ReviewController::class, 'show']);

  Route::put('/reviews/{review}', [ReviewController::class, 'update']);

  Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

  Route::get('/services/{service}/rating', [ReviewController::class, 'averageRating']);
});
