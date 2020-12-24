<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function() {
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'authenticate'])->name('authenticate')->middleware('throttle:5:10');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('register/submit', [UserController::class, 'submitRegistration'])->name('register.submit');
});
