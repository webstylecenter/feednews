<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::name('weather.')->prefix('weather')->group(function() {
    Route::get('/details', [WeatherController::class, 'details'])->name('detail');
    Route::get('/icon', [WeatherController::class, 'icon'])->name('icon');
});
