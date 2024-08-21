<?php
/**
 * @Author Samaa Yasin
 * 
 * 
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelController;

Route::get('/bookings', [AdminPanelController::class, 'listAll']);
Route::get('/bookings/{type}/{id}', [AdminPanelController::class, 'show']);
Route::post('/bookings/{type}', [AdminPanelController::class, 'store']);
Route::put('/bookings/{type}/{id}', [AdminPanelController::class, 'update']);
Route::delete('/bookings/{type}/{id}', [AdminPanelController::class, 'delete']);




Route::get('/users', [AdminPanelController::class, 'getAllUsers']);
Route::get('/users/{id}', [AdminPanelController::class, 'showUser']);
Route::post('/users', [AdminPanelController::class, 'createUser']);
Route::put('/users/{id}', [AdminPanelController::class, 'updateUser']);
Route::delete('/users/{id}', [AdminPanelController::class, 'deleteUser']);