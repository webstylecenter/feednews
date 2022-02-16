<?php

use App\Http\Controllers\IntroductionController;
use Illuminate\Support\Facades\Route;

Route::name('introduction.')->middleware(['web', 'auth'])->prefix('introduction')->group(function() {
    Route::get('/', [IntroductionController::class, 'index'])->name('index');
});
