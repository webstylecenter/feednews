<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::name('homepage.')->middleware(['web'])->group(function() {
    Route::get('/privacy-policy', [HomepageController::class, 'privacyPolicy'])->name('privacy.policy');
});

// Protected routes
Route::name('homepage.')->middleware(['web', 'auth'])->group(function() {

    Route::get('/', [HomepageController::class, 'index'])->name('index');
    Route::get('/offline', [HomepageController::class, 'offline'])->name('offline');
});
