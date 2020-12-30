<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Services\FeedService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use willvincent\Feeds\Facades\FeedsFacade;

class UpdateFeeds extends Command
{
    protected $signature = 'feed:update';
    protected $description = 'Loads every feed and adds new items to the database';
    private Feed $feed;
    private FeedService $feedService;
    private FeedsFacade $feedsReader;

    public function __construct(Feed $feed, FeedService $feedService, FeedsFacade $feedsReader)
    {
        parent::__construct();
        $this->feed = $feed;
        $this->feedService = $feedService;
        $this->feedsReader = $feedsReader;
    }

    public function handle()
    {
        $feeds = Feed::orderBy('updated_at', 'ASC')->get();

        foreach ($feeds as $feed) {
            $this->line(Carbon::now() . ' ' . $feed->name);
            $this->info(Carbon::now() . ' ' . $feed->name . ': Downloading...');

            try {
                $this->feedService->parseFeed($feed, $this);
            } catch (\Throwable $e) {
                // TODO: Add error logging
                $this->error(Carbon::now() . ' ' . $feed->name . ': Parsing failed.');
                $this->error($e);
                continue;
            }

            $feed->updated_at = Carbon::now();
            $feed->save();
            $this->info(Carbon::now() . ' ' . $feed->name . ': Parsed!');

        }

        $this->line(Carbon::now()
            . ' '
            . 'Finished updating feeds in '
            . (microtime(true) - LARAVEL_START)
            . ' seconds'
        );
    }
}
