<?php

namespace App\Services;

use App\Models\Feed;
use App\Models\FeedItem;
use App\Models\UserFeed;
use App\Models\UserFeedItem;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use willvincent\Feeds\Facades\FeedsFacade;

class FeedService
{
    private FeedsFacade $feedReader;
    private UserRepository $userRepository;

    public function __construct(FeedsFacade $feedReader, UserRepository $userRepository)
    {
        $this->feedReader = $feedReader;
        $this->userRepository = $userRepository;
    }

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

        return $availableFeeds->sortBy(['category', 'name']);
    }

    public function parseFeed(Feed $feed, ?Command $command = null): void
    {
        $feedData = $this->feedReader::make($feed->url);

        if ($command) {
            $command->info(Carbon::now() . ' ' . $feed->name . ': Parsing...');
        }

        $items = $feedData->get_items();

        if ($command) {
            $command->info(Carbon::now() . ' ' . $feed->name . ': Found ' . count($items) . ' items');
        }

        $newItems = 0;
        $skippedCacheItems = 0;
        foreach ($items as $item) {

            $guid = $item->get_id();

            if ($this->isInCache($guid) && $command !== null) {
                $skippedCacheItems++;
                continue;
            }

            if (DB::table('feed_items')->where('guid', $guid)->first()) {
                $this->addToFeedItemCache($guid);
                continue;
            }

            $feedItem = FeedItem::create([
                'feed_id' => $feed->id,
                'guid' => $item->get_id(),
                'title' => html_entity_decode($item->get_title()),
                'description' => html_entity_decode(substr($item->get_description() ?? $item->get_content(), 0, 255)),
                'url' => $item->get_link(),
                'created_at' => Carbon::parse($item->get_date())
            ]);

            $this->createUserFeedItems($feed, $feedItem);
            $this->addToFeedItemCache($guid);
            $newItems++;
        }

        if ($command) {
            $command->warn(Carbon::now() . ' ' . $feed->name . ': Added ' . $newItems . ' new items, skipped ' . $skippedCacheItems . ' cached items');
        }
    }

    public function setOpenedItemForUser(int $userFeedItemId): void
    {
        $userFeeditem = UserFeedItem::where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $userFeedItemId)
            ->first();

        if (!$userFeeditem) {
            return;
        }

        $userFeeditem->opened_at = Carbon::now();
        $userFeeditem->save();
    }

    public function getOpenedItems(): array
    {
        $output = [];
        foreach ($this->userRepository->getOpenedItems() as $openedItem) {
            $output[] = $openedItem;
        }

        return $output;
    }

    public function search(string $query): array
    {
        $output = [];
        foreach ($this->userRepository->search($query) as $openedItem) {
            $output[] = $openedItem;
        }

        return $output;
    }

    public function findOrCreateFeedByUrl($url)
    {
        $feed = Feed::where('url', '=', $url)->first();

        if (!$feed) {
            $feed = new Feed();
            $feed->url = $url;
            return $feed;
        }

        return $feed;
    }

    protected function createUserFeedItems(Feed $feed, FeedItem $feedItem): void
    {
        foreach ($feed->userFeeds as $userFeed) {
            UserFeedItem::create([
                'user_id' => $userFeed->user_id,
                'user_feed_id' => $userFeed->id,
                'feed_item_id' => $feedItem->id,
                'pinned' => $userFeed->auto_pin
            ]);
        }
    }

    protected function isInCache(string $value): bool
    {
        return Cache::has('feed_item_cache_' . Str::slug($value));
    }

    protected function addToFeedItemCache(string $value): void
    {
        Cache::put('feed_item_cache_' . Str::slug($value), true, now()->addDays(rand(7, 31)));
    }
}
