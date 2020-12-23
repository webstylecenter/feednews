<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::name('feedback.')->prefix('feedback')->group(function() {
    Route::get('/', [FeedbackController::class, 'index'])->name('index');
});
