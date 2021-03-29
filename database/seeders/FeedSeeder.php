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
        ]);

        Feed::create([
            'name' => 'Neowin',
            'url' => 'http://feeds.feedburner.com/neowin-main',
        ]);

        FeedItem::factory(250)->create();

    }
}
