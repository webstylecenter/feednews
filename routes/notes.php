<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::name('notes.')->prefix('notes')->group(function() {
    Route::post('/save', [NoteController::class, 'save'])->name('save');
    Route::post('/remove', [NoteController::class, 'remove'])->name('remove');
});
