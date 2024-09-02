<?php

/**
 * @Author Adam Akram
 * 
 * 
 */

use App\Http\Controllers\BookingFlightController;
use App\Http\Controllers\BookingCarController;
use App\Http\Controllers\BookingHotelController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::prefix('booking/flights')->group(function () {

        Route::get('/', [BookingFlightController::class, 'show']);

        Route::post('/', [BookingFlightController::class, 'create']);

        Route::put('/{id}', [BookingFlightController::class, 'update']);

        Route::delete('/{id}', [BookingFlightController::class, 'cancel']);
    });

    Route::prefix('booking/cars')->group(function () {

        Route::get('/', [BookingCarController::class, 'show']);

        Route::post('/', [BookingCarController::class, 'create']);

        Route::put('/{id}', [BookingCarController::class, 'update']);
        
        Route::delete('/{id}', [BookingCarController::class, 'cancel']);
    });

    Route::prefix('booking/hotels')->group(function () {

        Route::get('/', [BookingHotelController::class, 'show']);

        Route::post('/', [BookingHotelController::class, 'create']);

        Route::put('/{id}', [BookingHotelController::class, 'update']);

        Route::delete('/{id}', [BookingHotelController::class, 'cancel']);
    });
});
