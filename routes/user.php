<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function() {
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'authenticate'])->name('authenticate')->middleware('throttle:5:10');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('register/submit', [UserController::class, 'submitRegistration'])->name('register.submit');

    // Google
    // TODO: Improve urls
    Route::get('/auth/redirect', [UserController::class, 'redirectToOauth'])->name('oauth.redirect');
    Route::get('/auth/callback', [UserController::class, 'oAuthCallBack'])->name('oauth.callback');

    // Facebook
    Route::get('/auth/facebook/redirect', [UserController::class, 'facebookRedirectToOauth'])->name('oauth.facebook.redirect');
    Route::get('/auth/facebook/callback', [UserController::class, 'facebookoAuthCallBack'])->name('oauth.facebook.callback');
    Route::get('/auth/facebook/remove', [UserController::class, 'facebookRemoveUser'])->name('oauth.facebook.remove');
});
