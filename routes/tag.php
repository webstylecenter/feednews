<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::name('tag.')->middleware(['web', 'auth'])->prefix('tags')->group(function() {
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::post('/add', [TagController::class, 'add'])->name('add');
    Route::post('/remove', [TagController::class, 'remove'])->name('remove');
});
