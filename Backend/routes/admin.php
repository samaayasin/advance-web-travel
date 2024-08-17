<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelController;

Route::get('/bookings', [AdminPanelController::class, 'getall']);
Route::get('/bookings/{type}/{id}', [AdminPanelController::class, 'show']);
Route::post('/bookings/{type}', [AdminPanelController::class, 'store']);
Route::put('/bookings/{type}/{id}', [AdminPanelController::class, 'update']);
Route::delete('/bookings/{type}/{id}', [AdminPanelController::class, 'delete']);
