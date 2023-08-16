<?php

use App\Http\Controllers\OverlayFormsController;
use Illuminate\Support\Facades\Route;

Route::name('overlay.')->middleware(['web', 'auth'])->prefix('overlay')->group(function() {
    Route::get('/add-feed-item', [OverlayFormsController::class, 'addFeedItem'])->name('add-feed-item');
    Route::get('/add-tag', [OverlayFormsController::class, 'addTag'])->name('add-tag');
    Route::get('/tag-feed-item/{id}', [OverlayFormsController::class, 'tagFeedItem'])->name('tag-feed-item');
});
