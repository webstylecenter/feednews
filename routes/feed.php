<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::name('feed.')->prefix('feed')->middleware(['web'])->group(function() {

    Route::middleware(['auth'])->group(function() {
        Route::post('/add', [FeedController::class, 'add'])->name('add');

        Route::post('/get-meta-data', [FeedController::class, 'getMetaData'])->name('metadata');
        Route::post('/pin', [FeedController::class, 'pin'])->name('pin');
        Route::get('/load-more/{page}', [FeedController::class, 'loadMore'])->name('load.more');
        Route::get('/search', [FeedController::class, 'search'])->name('search');
        Route::get('/overview', [FeedController::class, 'overview'])->name('overview');
        Route::post('/check-x-frame-header', [FeedController::class, 'checkForXFrameHeader'])->name('check.x.frame.header');
        Route::get('/popup-has-been-opened', [FeedController::class, 'popupOpened'])->name('popup.opened');
        Route::get('/opened-items', [FeedController::class, 'getOpenedItems'])->name('opened.items');
        Route::post('/set-opened-item', [FeedController::class, 'setOpenedItem'])->name('set.opened.item');
        Route::post('/create-feed-item', [FeedController::class, 'createFeedItem'])->name('create');
    });

    Route::post('/chrome-import/{email?}', [FeedController::class, 'chromeImport'])->name('chrome.import');
});

Route::name('feed.')->group(function() {
    Route::get('/share/{feedName}/{id}', [FeedController::class, 'openSharedItem'])->name('open.shared.item');
});
