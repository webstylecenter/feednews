<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::name('weather.')->prefix('weather')->group(function() {
    Route::get('/', [WeatherController::class, 'index'])->name('index');
});
