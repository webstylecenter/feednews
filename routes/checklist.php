<?php

use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;

Route::name('checklist.')->prefix('checklist')->group(function() {
    Route::get('/', [ChecklistController::class, 'index'])->name('index');
    Route::post('/update', [ChecklistController::class, 'update'])->name('update');
});
