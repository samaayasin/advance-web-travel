<?php
/**
 * @Author Aisha Ishtayeh
 * 
 * 
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelController;

// Get All APIs
Route::get('/get/flights', [FlightController::class, 'getFlight']);

Route::get('/get/hotels',  [HotelController::class, 'getFlight']);

Route::get('/get/cars',  [CarController::class, 'getFlight']);

// Search routes for each  type
Route::get('/search/flights', [FlightController::class, 'search']);

Route::get('/search/hotels',  [HotelController::class, 'search']);

Route::get('/search/cars',  [CarController::class, 'search']);