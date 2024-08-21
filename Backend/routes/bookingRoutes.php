<?php
/**
 * @Author Adam Akram
 * 
 * 
 */
use App\Http\Controllers\FlightController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('booking/flights')->group(function () {

        Route::get('/', [FlightController::class, 'show_all_flight']);

        Route::get('/{id}', [FlightController::class, 'show_flight']);

        Route::post('/', [FlightController::class, 'add_booking_flight']);

        Route::put('/{id}', [FlightController::class, 'update_booking_flight']);

        Route::delete('/{id}', [FlightController::class, 'cancel_booking_flight']);
    });

    Route::prefix('booking/cars')->group(function () {


        Route::get('/', [CarController::class, 'show_all_cars']);

        Route::post('/', [CarController::class, 'booking_car']);

        Route::put('/{id}', [CarController::class, 'update_booking_car']);

        Route::delete('/{id}', [CarController::class, 'cancel_booking_car']);
    });

    Route::prefix('booking/hotels')->group(function () {

        Route::get('/', [HotelController::class, 'show_all_hotels']);

        Route::post('/', [HotelController::class, 'booking_hotel']);

        Route::put('/{id}', [HotelController::class, 'update_booking_hotel']);

        Route::delete('/{id}', [HotelController::class, 'cancel_booking_hotel']);
    });
});
