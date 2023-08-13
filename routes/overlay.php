<?php

use App\Http\Controllers\OverlayFormsController;
use Illuminate\Support\Facades\Route;

Route::name('overlay.')->middleware(['web', 'auth'])->prefix('overlay')->group(function() {
    Route::get('/add-new-feed-item', [OverlayFormsController::class, 'addNewFeedItem'])->name('add-new-feed-item');
});
