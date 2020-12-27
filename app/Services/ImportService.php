<?php

namespace App\Services;

use App\Models\FeedItem;
use App\Models\UserFeed;
use App\Models\UserFeedItem;
use Illuminate\Support\Facades\Auth;

class ImportService
{
    public function addOldItemsToUserFeed(UserFeed $userFeed): void
    {
        FeedItem::where('feed_id', '=', $userFeed->feed->id)
            ->orderBy('created_at', 'DESC')
            ->take(25)
            ->get()
            ->each(function($feedItem) use ($userFeed) {
                echo 'test '.$feedItem->id.'<br />';

                 UserFeedItem::create([
                     'user_id' => Auth::user()->id,
                     'feed_item_id' => $feedItem->id,
                     'user_feed_id' => $userFeed->id,
                     'pinned' => $userFeed->auto_pin,
                     'viewed' => false,
                 ]);
        });
    }
}
