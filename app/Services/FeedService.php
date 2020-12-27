<?php

namespace App\Services;

use App\Models\Feed;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FeedService
{
    public function getAvailableFeeds(): Collection
    {
        $availableFeeds = new Collection();
        $userFeeds = Auth::user()->userFeeds()->get();

        foreach (Feed::all() as $feed) {
            $found = false;
            foreach ($userFeeds as $userFeed) {
                if ($feed->id === $userFeed->feed->id) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $availableFeeds->add($feed);
            }
        }

        return $availableFeeds;
    }
}
