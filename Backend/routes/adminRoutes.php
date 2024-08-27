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

Route::get('/availables', [AdminPanelController::class, 'listAllAvailables']);
Route::get('/availables/{type}', [AdminPanelController::class, 'listAvailableType']);
Route::get('/availables/{type}/{id}', [AdminPanelController::class, 'showAvailable']);
Route::post('/availables/{type}', [AdminPanelController::class, 'storeAvailable']);
Route::put('/availables/{type}/{id}', [AdminPanelController::class, 'updateAvailable']);
Route::delete('/availables/{type}/{id}', [AdminPanelController::class, 'deleteAvailable']);