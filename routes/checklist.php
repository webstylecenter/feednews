<?php

use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;

Route::name('checklist.')->middleware(['web', 'auth'])->prefix('checklist')->group(function() {
    Route::get('/', [ChecklistController::class, 'index'])->name('index');
    Route::post('/add', [ChecklistController::class, 'add'])->name('add');
    Route::post('/update', [ChecklistController::class, 'update'])->name('update');
});
