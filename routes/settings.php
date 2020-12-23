<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::name('settings.')->prefix('settings')->group(function() {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/add', [SettingController::class, 'add'])->name('add');
    Route::post('/follow', [SettingController::class, 'follow'])->name('follow');
    Route::post('/update', [SettingController::class, 'update'])->name('update');
    Route::post('/remove', [SettingController::class, 'remove'])->name('remove');
    Route::get('/disable-x-frame-notice', [SettingController::class, 'disableXFrameNotice'])->name('disable.x.frame.notice');
    Route::post('/validate-url', [SettingController::class, 'validateUrl'])->name('validate.url');
    Route::post('/create-user-feed', [SettingController::class, 'createUserFeed'])->name('create.user.feed');
});
