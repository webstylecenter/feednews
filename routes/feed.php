<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::name('feed.')->prefix('feed')->group(function() {
    Route::post('/add', [FeedController::class, 'add'])->name('add');
    Route::post('/chrome-import', [FeedController::class, 'chromeImport'])->name('chrome.import');
    Route::get('/get-meta-data', [FeedController::class, 'getMetaData'])->name('metadata');
    Route::post('/pin', [FeedController::class, 'pin'])->name('pin');
    Route::get('/refresh', [FeedController::class, 'refresh'])->name('refresh');
    Route::get('/load-more', [FeedController::class, 'loadMore'])->name('load.more');
    Route::post('/search', [FeedController::class, 'search'])->name('search');
    Route::get('/overview', [FeedController::class, 'overview'])->name('overview');
    Route::get('/check-x-frame-header', [FeedController::class, 'checkForXFrameHeader'])->name('check.x.frame.header');
    Route::get('/popup-has-been-opened', [FeedController::class, 'popupOpened'])->name('popup.opened');
    Route::get('/open-shared-item', [FeedController::class, 'openSharedItem'])->name('open.shared.item');
    Route::get('/opened-items', [FeedController::class, 'getOpenedItems'])->name('opened.items');
    Route::post('/create-feed-item', [FeedController::class, 'createFeedItem'])->name('create');
});
