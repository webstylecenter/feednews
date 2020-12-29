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

        return $availableFeeds;
    }

    public function parseFeed(Feed $feed, ?Command $command): void
    {
        $feedData = $this->feedReader::make($feed->url);
        $command->info(Carbon::now() . ' ' . $feed->name . ': Parsing...');

        $items = $feedData->get_items();

        if ($command) {
            $command->info(Carbon::now() . ' ' . $feed->name . ': Found ' . count($items) . ' items');
        }

        $newItems = 0;
        foreach ($items as $item) {
            if (FeedItem::where('guid', '=', $item->get_id())->first()) {
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
            $newItems++;
        }

        if ($command) {
            $command->info(Carbon::now() . ' ' . $feed->name . ': Added ' . $newItems . ' new items');
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

    protected function createUserFeedItems(Feed $feed, FeedItem $feedItem): void
    {
        foreach (UserFeed::where('feed_id', '=', $feed->id)->get() as $userFeed) {
            UserFeedItem::create([
                'user_id' => $userFeed->user_id,
                'user_feed_id' => $userFeed->id,
                'feed_item_id' => $feedItem->id,
            ]);
        }
    }
}
