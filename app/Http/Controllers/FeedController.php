<?php

namespace App\Http\Controllers;

use App\Models\FeedItem;
use App\Models\Meta;
use App\Models\User;
use App\Models\UserFeedItem;
use App\Repositories\UserRepository;
use App\Services\FeedService;
use App\Services\MetaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FeedController extends BaseController
{
    public function add(Request $request, FeedItem $feedItem, UserFeedItem $userFeedItem, MetaService $metaService, Meta $meta): array
    {
        $request->validate([
            'url' => 'required',
        ]);

        if (!$request->get('title')) {
            $meta = $metaService->getMetaByUrl($request->get('url'));
        } else {
            $meta->title = $request->get('title');
            $meta->description = $request->get('description');
            $meta->url = $request->get('url');
        }

        $feedItem = $feedItem->create([
            'guid' => sha1(time()),
            'title' => $meta->title,
            'description' => $meta->description,
            'url' => $meta->url
        ]);

        $userFeedItem->create([
            'user_id' => Auth::user()->id,
            'feed_item_id' => $feedItem->id,
            'pinned' => true
        ]);

        return [
            'status' => 'success',
            'data' => [
                'title' => $feedItem->title,
                'description' => $feedItem->description,
                'url' => $feedItem->url
            ]
        ];
    }

    public function chromeImport(
        ?string $email = null,
        Request $request,
        MetaService $metaService,
        FeedItem $feedItem,
        UserFeedItem $userFeedItem
    ): array {
        try {
            $meta = $metaService->getMetaByUrl($request->get('url'));

            $feedItem = $feedItem->create([
                'guid' => sha1(time()),
                'title' => $meta->title,
                'description' => $meta->description,
                'url' => $meta->url
            ]);

            $userFeedItem->create([
                'user_id' => Auth::user()->id,
                'feed_item_id' => $feedItem->id,
                'pinned' => true
            ]);
        } catch (\Throwable $e) {
            if (strlen($email) > 0) {
                Auth::logout();
            }

            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];

        }

        return [
            'status' => 'success',
            'title' => $meta->title,
            'description' => $meta->description,
            'url' => $meta->url,
            'id' => $feedItem->id,
        ];
    }

    public function androidImport(
        string $url,
        Request $request,
        MetaService $metaService,
        FeedItem $feedItem,
        UserFeedItem $userFeedItem
    ): View {
        // TODO: Remove duplicate code
        try {
            $meta = $metaService->getMetaByUrl(base64_decode($url));

            $feedItem = $feedItem->create([
                'guid' => sha1(time()),
                'title' => $meta->title,
                'description' => $meta->description,
                'url' => $meta->url
            ]);

            $userFeedItem->create([
                'user_id' => Auth::user()->id,
                'feed_item_id' => $feedItem->id,
                'pinned' => true
            ]);
        } catch (\Throwable $e) {
            return view('android.import', [
                'title' => 'Something went wrong',
                'description' => $e->getMessage(),
                'url' => base64_decode($url),
                'status' => 'Failed',
                'bodyClass'=>'android-import'
            ]);
        }

        return view('android.import', [
            'title' => $meta->title,
            'description' => $meta->description,
            'url' => base64_decode($url),
            'status' => 'Succeeded',
            'bodyClass'=>'android-import'
        ]);
    }

    public function getMetaData(Request $request, MetaService $metaService): array
    {
        $request->validate([
            'url' => 'required'
        ]);

        $meta = $metaService->getMetaByUrl($request->get('url'));

        return [
            'status' => 'success',
            'data' => [
                'title' => $meta->title,
                'description' => $meta->description
            ]
        ];
    }

    public function pin(Request $request): array
    {
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $userFeedItem = UserFeedItem::find($request->get('id'));
        $userFeedItem->pinned = !$userFeedItem->pinned;
        $userFeedItem->save();

        return [
            'status' => 'success',
            'message' => 'Pin toggled',
            'current_state' => $userFeedItem->pinned
        ];
    }

    public function loadMore(int $page, UserRepository $userRepository): View
    {
        $userFeedItems = $userRepository->getFeedItems(50, $page);

        return view('home.components.newsfeed', [
            'userFeedItems' => $userFeedItems,
            'nextPageNumber' => $userFeedItems->count() > 0 ? ($page + 1) : null
        ]);
    }

    public function search(Request $request, FeedService $feedService): array
    {
        $request->validate([
            'query' => ['required', 'min:2']
        ]);

        return [
            'status' => 'success',
            'data' => array_map('self::mapUserFeedItemToArray', $feedService->search($request->get('query')))
        ];
    }

    public function overview(): View
    {
        return view('widgets.feed-overview', [
            'userFeeds' => Auth::user()->userFeeds()->get()
        ]);
    }

    public function checkForXFrameHeader(Request $request): array
    {
        try {
            $header = get_headers($request->get('url'), 1);
        } catch(\Throwable $e) {
            return [
                'found' => false,
                'not_sure' => true
            ];
        }

        return [
            'found' => isset($header['X-Frame-Options']) || isset($header['x-frame-options']),
        ];
    }

    public function view(int $id): View
    {
        $feedItem = UserFeedItem::find($id);

        return view('feed-item.index', [
            'bodyClass' => 'feedItemContent',
            'feed_title' => $feedItem?->feedItem?->feed?->name,
            'feed_item_title' => $feedItem?->feedItem?->title,
            'feed_item_content' => $feedItem?->feedItem?->feedContent?->content,
        ]);
    }

    public function openSharedItem(string $feedName, int $userFeedItemId): RedirectResponse
    {
        return redirect(UserFeedItem::find($userFeedItemId)->feedItem->url);
    }

    public function setOpenedItem(Request $request, FeedService $feedService): array
    {
        $request->validate([
            'userFeedItemId' => ['required', 'integer']
        ]);

        $feedService->setOpenedItemForUser($request->get('userFeedItemId'));

        return [
            'status' => 'success',
            'message' => 'Item set to opened'
        ];
    }

    public function getOpenedItems(FeedService $feedService): array
    {
        return [
            'status' => 'success',
            'items' => array_map('self::mapUserFeedItemToArray', $feedService->getOpenedItems())
        ];
    }

    public function getItemsByTag(int $tagId, FeedService $feedService): array
    {
        return [
            'status' => 'success',
            'items' => array_map('self::mapUserFeedItemToArray', $feedService->getByTag($tagId))
        ];
    }

    static private function mapUserFeedItemToArray(UserFeedItem $userFeedItem): array
    {
        return [
            'id' => $userFeedItem->user_feed_item_id,
            'title' => $userFeedItem->title,
            'description' => strlen($userFeedItem->description) > 0 ? $userFeedItem->description : $userFeedItem?->feedItem?->feed?->name,
            'url' => $userFeedItem->url,
            'color' => $userFeedItem->feed_color ?? '',
            'feedIcon' => $userFeedItem->feed_icon ?? '',
            'shareId' => ($userFeedItem->name ? Str::slug($userFeedItem->name) : 'item') . '/' . $userFeedItem->id . '/',
            'pinned' => $userFeedItem->pinned
        ];
    }
}
