<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected ?User $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

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
                'user_feeds.icon AS feed_icon',
                'user_feed_items.created_at AS created_at',
                'user_feed_items.updated_at AS updated_at',
            ])
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->leftJoin('user_feeds', 'user_feed_id', 'user_feeds.id')
            ->leftJoin('feeds', 'user_feeds.feed_id', 'feeds.id')
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
            ->select([
                '*',
                'user_feed_items.id AS user_feed_item_id',
                'user_feed_items.updated_at AS user_feed_item_updated_at',
                'feed_items.url AS url',
                'user_feeds.color AS feed_color',
                'user_feeds.icon AS feed_icon',
                'user_feed_items.created_at AS created_at',
                'user_feed_items.updated_at AS updated_at',
            ])
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->leftJoin('user_feeds', 'user_feed_id', 'user_feeds.id')
            ->leftJoin('feeds', 'user_feeds.feed_id', 'feeds.id')
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
            ->select([
                '*',
                'user_feed_items.id AS user_feed_item_id',
                'user_feed_items.updated_at AS user_feed_item_updated_at',
                'feed_items.url AS url',
                'user_feeds.color AS feed_color',
                'user_feeds.icon AS feed_icon',
                'user_feed_items.created_at AS created_at',
                'user_feed_items.updated_at AS updated_at',
            ])
            ->join('feed_items', 'feed_item_id', 'feed_items.id')
            ->leftJoin('user_feeds', 'user_feed_id', 'user_feeds.id')
            ->leftJoin('feeds', 'user_feeds.feed_id', 'feeds.id')
            ->where('feed_items.title', 'like', '%' . $query .'%')
            ->orderBy('user_feed_items.pinned', 'DESC')
            ->orderBy('user_feed_items.opened_at', 'DESC')
            ->take(25)
            ->get();
    }

    public function updateLatestLoginDate(): void
    {
        $this->user->last_login = new \DateTime('NOW');
        $this->user->save();
    }

    public function remove(User $user): void
    {
        $user->delete();
    }
}
