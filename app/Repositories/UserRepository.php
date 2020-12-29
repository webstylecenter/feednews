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
            ->orderBy('pinned', 'DESC')
            ->orderBy('created_at', 'DESC')
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
            ->whereNotNull('opened_at')
            ->orderBy('opened_at', 'DESC')
            ->take(50)
            ->get();
    }

    public function search(string $query): Collection
    {
        return Auth::user()
            ->feedItems()
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->where('feed_items.title', 'like', '%' . $query .'%')
            ->orderBy('pinned', 'DESC')
            ->orderBy('opened_at', 'DESC')
            ->take(25)
            ->get();
    }
}
