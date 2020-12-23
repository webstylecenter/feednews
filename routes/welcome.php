<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::name('welcome.')->prefix('welcome')->group(function() {
    Route::get('/', [WelcomeController::class, 'index'])->name('index');
});
