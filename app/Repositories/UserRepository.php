<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getFeedItems(int $limit = 50, $page = null): Collection
    {
        $feedItems = Auth::user()
            ->feedItems()
            ->select([
                '*',
                'user_feed_items.id AS user_feed_item_id',
                'user_feed_items.updated_at AS user_feed_item_updated_at',
                'feed_items.url AS url',
                'user_feeds.color AS feed_color',
                'user_feeds.icon AS feed_icon'
            ])
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->join('user_feeds', 'user_feed_id', 'user_feeds.id')
            ->join('feeds', 'user_feeds.feed_id', 'feeds.id')
            ->orderBy('user_feed_items.pinned', 'DESC')
            ->orderBy('user_feed_items.created_at', 'DESC')
            ->skip($page * $limit)
            ->take($limit)
            ->get();

        foreach ($feedItems as $feedItem) {
            if (!$feedItem->viewed) {
                $feedItem->viewed = true;
                $feedItem->save();
            }
        }

        return $feedItems;
    }

    public function getOpenedItems(): Collection
    {
        return Auth::user()
            ->feedItems()
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->join('user_feeds', 'user_feed_id', 'user_feeds.id')
            ->whereNotNull('user_feed_items.opened_at')
            ->orderBy('user_feed_items.pinned', 'DESC')
            ->orderBy('user_feed_items.opened_at', 'DESC')
            ->take(50)
            ->get();
    }

    public function search(string $query): Collection
    {
        return Auth::user()
            ->feedItems()
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->join('user_feeds', 'user_feed_id', 'user_feeds.id')
            ->where('feed_items.title', 'like', '%' . $query .'%')
            ->orderBy('user_feed_items.pinned', 'DESC')
            ->orderBy('user_feed_items.opened_at', 'DESC')
            ->take(25)
            ->get();
    }
}
