<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::name('feedback.')->middleware(['web', 'auth'])->prefix('feedback')->group(function() {
    Route::get('/', [FeedbackController::class, 'index'])->name('index');
});
