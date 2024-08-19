<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingCarController;
use App\Http\Controllers\BookingFlightController;
use App\Http\Controllers\BookingHotelController;

// Get All APIs
Route::get('/get/flights', [BookingFlightController::class, 'getFlight']);

Route::get('/get/hotels',  [BookingHotelController::class, 'getFlight']);

Route::get('/get/cars',  [BookingCarController::class, 'getFlight']);

// Search routes for each booking type
Route::get('/search/flights', [BookingFlightController::class, 'search']);

Route::get('/search/hotels',  [BookingHotelController::class, 'search']);

Route::get('/search/cars',  [BookingCarController::class, 'search']);