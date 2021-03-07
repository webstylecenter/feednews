<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Repositories\ErrorRepository;
use App\Services\FeedService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use willvincent\Feeds\Facades\FeedsFacade;

class UpdateFeeds extends Command
{
    protected $signature = 'feed:update';
    protected $description = 'Loads every feed and adds new items to the database';
    private Feed $feed;
    private FeedService $feedService;
    private FeedsFacade $feedsReader;
    private ErrorRepository $errorRepository;

    public function __construct(Feed $feed, FeedService $feedService, FeedsFacade $feedsReader, ErrorRepository $errorRepository)
    {
        parent::__construct();
        $this->feed = $feed;
        $this->feedService = $feedService;
        $this->feedsReader = $feedsReader;
        $this->errorRepository = $errorRepository;
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
                $this->errorRepository->report(
                    3,
                    $e->getMessage(),
                    null,
                    $feed
                );

                // TODO: Add error logging
                $this->error(Carbon::now() . ' ' . $feed->name . ': Parsing failed.');
                $this->error($e->getMessage());
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
