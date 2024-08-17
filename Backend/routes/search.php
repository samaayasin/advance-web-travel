<?php

use Illuminate\Support\Facades\Route;


// Get All APIs
Route::get('/get/flights', '\App\Http\Controllers\BookingFlightController@getFlight');
Route::get('/get/hotels', '\App\Http\Controllers\BookingHotelController@getHotel');
Route::get('/get/cars', '\App\Http\Controllers\BookingCarController@getCar');

// Search routes for each booking type
Route::get('/search/flights', '\App\Http\Controllers\BookingFlightController@search');
Route::get('/search/hotels', '\App\Http\Controllers\BookingHotelController@search');
Route::get('/search/cars', '\App\Http\Controllers\BookingCarController@search');