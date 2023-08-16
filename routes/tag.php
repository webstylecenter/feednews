<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::name('tag.')->middleware(['web'])->prefix('tags')->group(function() {
    Route::middleware(['auth'])->group(function() {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::post('/add', [TagController::class, 'add'])->name('add');
        Route::post('/user-feed-item', [TagController::class, 'tagUserFeedItem'])->name('add');
        Route::post('/remove', [TagController::class, 'remove'])->name('remove');
    });
});
