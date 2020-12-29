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
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
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
        ?string $email,
        Request $request,
        MetaService $metaService,
        FeedItem $feedItem,
        UserFeedItem $userFeedItem,
        User $user
    ): array {
        if (strlen($email) > 0 && !Auth::check()) {
            $user = $user->where('email', '=', $email)->first();

            if (!$user) {
                abort(403);
            }

            Auth::loginUsingId($user->id);
        }

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

        if (strlen($email) > 0) {
            Auth::logout();
        }

        return [
            'status' => 'success',
            'title' => $meta->title,
            'description' => $meta->description,
            'url' => $meta->url
        ];
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
            'data' => array_map(function (UserFeedItem $userFeedItem) {
                $feedItem = $userFeedItem->feedItem;

                return [
                    'id' => $userFeedItem->id,
                    'title' => $feedItem->title,
                    'description' => $feedItem->description,
                    'url' => $feedItem->url,
                    'color' => ($userFeedItem->userFeed !== null ? $userFeedItem->userFeed->color : ''),
                    'feedIcon' => ($userFeedItem->userFeed !== null ? $userFeedItem->userFeed->icon : ''),
                    'shareId' => ($userFeedItem->userFeed !== null ? Str::slug($userFeedItem->userFeed->feed->name) : 'item') . '/' . $userFeedItem->id . '/',
                    'pinned' => $userFeedItem->is_pinned
                ];
            }, $feedService->search($request->get('query')))
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
            'found' => isset($header['X-Frame-Options']),
        ];
    }

    public function popupOpened(): View
    {
        return view('widgets.opened-in-popup');
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
            'items' => array_map(function (UserFeedItem $userFeedItem) {
                $feedItem = $userFeedItem->feedItem;

                return [
                    'id' => $userFeedItem->id,
                    'title' => $feedItem->title,
                    'description' => $feedItem->description,
                    'url' => $feedItem->url,
                    'color' => ($userFeedItem->userFeed !== null ? $userFeedItem->userFeed->color : ''),
                    'feedIcon' => ($userFeedItem->userFeed !== null ? $userFeedItem->userFeed->icon : ''),
                    'shareId' => ($userFeedItem->userFeed !== null ? Str::slug($userFeedItem->userFeed->feed->name) : 'item') . '/' . $userFeedItem->id . '/',
                    'pinned' => $userFeedItem->is_pinned
                ];
            }, $feedService->getOpenedItems())
        ];
    }
}
