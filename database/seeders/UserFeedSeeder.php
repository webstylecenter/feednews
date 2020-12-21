<?php

namespace Database\Seeders;

use App\Models\FeedItem;
use App\Models\UserFeed;
use App\Models\UserFeedItem;
use Illuminate\Database\Seeder;

class UserFeedSeeder extends Seeder
{
    public function run(): void
    {
        $firstUserFeed = UserFeed::create([
            'user_id' => 1,
            'feed_id' => 1,
            'icon' => null,
            'color' => '#c3c3c3',
            'auto_pin' => false
        ]);

        $secondUserFeed = UserFeed::create([
            'user_id' => 1,
            'feed_id' => 2,
            'icon' => null,
            'color' => '#00000',
            'auto_pin' => true
        ]);

        foreach (FeedItem::all() as $feedItem) {
            UserFeedItem::create([
                'user_id' => 1,
                'feed_item_id' => $feedItem->id,
                'user_feed_id' => $firstUserFeed->id,
                'viewed' => false,
                'pinned' => rand(1, 25) === 1,
                'opened_at' => null
            ]);

            UserFeedItem::create([
                'user_id' => 1,
                'feed_item_id' => $feedItem->id,
                'user_feed_id' => $secondUserFeed->id,
                'viewed' => false,
                'pinned' => rand(1, 25) === 1,
                'opened_at' => null
            ]);
        }
    }
}
