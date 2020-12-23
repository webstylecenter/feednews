<?php

use App\Http\Controllers\ScreensaverController;
use Illuminate\Support\Facades\Route;

Route::name('screensaver.')->prefix('screensaver')->group(function() {
    Route::get('/', [ScreensaverController::class, 'index'])->name('index');
    Route::get('/background-image', [ScreensaverController::class, 'backgroundImage'])->name('background.image');
});
