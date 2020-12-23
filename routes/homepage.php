<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::name('homepage.')->group(function() {
    Route::get('/', [HomepageController::class, 'index'])->name('index');
    Route::get('/offline', [HomepageController::class, 'offline'])->name('offline');
    Route::get('/privacy-policy', [HomepageController::class, 'privacyPolicy'])->name('privacy.policy');
});
