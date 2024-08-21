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

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('booking/flights')->group(function () {

        Route::get('/', [BookingFlightController::class, 'show_all_flight']);

        Route::get('/{id}', [BookingFlightController::class, 'show_flight']);

        Route::post('/', [BookingFlightController::class, 'add_booking_flight']);

        Route::put('/{id}', [BookingFlightController::class, 'update_booking_flight']);

        Route::delete('/{id}', [BookingFlightController::class, 'cancel_booking_flight']);
    });

    Route::prefix('booking/cars')->group(function () {


        Route::get('/', [BookingCarController::class, 'show_all_cars']);

        Route::post('/', [BookingCarController::class, 'booking_car']);

        Route::put('/{id}', [BookingCarController::class, 'update_booking_car']);

        Route::delete('/{id}', [BookingCarController::class, 'cancel_booking_car']);
    });

    Route::prefix('booking/hotels')->group(function () {

        Route::get('/', [BookingHotelController::class, 'show_all_hotels']);

        Route::post('/', [BookingHotelController::class, 'booking_hotel']);

        Route::put('/{id}', [BookingHotelController::class, 'update_booking_hotel']);

        Route::delete('/{id}', [BookingHotelController::class, 'cancel_booking_hotel']);
    });
});
