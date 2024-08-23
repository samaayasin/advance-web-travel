<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::post('{bookingType}/{bookingId}/reviews', [ReviewController::class, 'storeReview'])->middleware('auth:api');

Route::get('{bookingType}/{bookingId}/reviews', [ReviewController::class, 'getReviews']);

Route::put('{bookingType}/{bookingId}/reviews/{reviewId}', [ReviewController::class, 'updateReview'])->middleware('auth:api');

Route::delete('{bookingType}/{bookingId}/reviews/{reviewId}', [ReviewController::class, 'deleteReview'])->middleware('auth:api');
