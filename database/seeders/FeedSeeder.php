<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feed;
use App\Models\FeedItem;

class FeedSeeder extends Seeder
{
    public function run(): void
    {
        Feed::create([
            'name' => 'iDownloadBlog.com',
            'url' => 'https://www.idownloadblog.com/feed/',
            'color' => '#c5c5c5'
        ]);

        Feed::create([
            'name' => 'Neowin',
            'url' => 'http://feeds.feedburner.com/neowin-main',
            'color' => '#4c91d4'
        ]);

        FeedItem::factory(250)->create();

    }
}
