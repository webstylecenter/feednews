<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedCategory;
use App\Models\User;
use App\Models\UserFeed;
use App\Services\FeedService;
use App\Services\ImportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class SettingController extends BaseController
{
    public function index(FeedService $feedService)
    {
        return view('settings.index', [
            'bodyClass' => 'settings',
            'isAdmin' => Auth::user()->is_admin,
            'availableFeeds' => $feedService->getAvailableFeeds(),
            'userFeeds' => Auth::user()->userFeeds->sortBy('feed.name'),
            'users' => User::all(),
            'categories' => FeedCategory::all(),
            'feeds' => Feed::orderBy('created_at', 'desc')->limit(5)->get(),
        ]);
    }

    public function add(Request $request, ImportService $importService, FeedService $feedService): array
    {
        // TODO: Validate category id

        $url = $importService->validateUrl($request);

        if (strpos($url, 'Error') !== false) {
            return [
                'status' => 'error',
                'message' => $url
            ];
        }

        $feed = $feedService->findOrCreateFeedByUrl($url);

        try {
            $feed->name = $importService->getFeedName($feed);
            $feed->category_id = $request->get('category', null);
            $feed->save();
        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'message' => '<b>Not a valid feed</b><br />Url: ' . $url . '<br /><br /><small style="color:gray;">' . $exception . '</small>'
            ];
        }

        if (!$feed->id) {
            return [
                'status' => 'error',
                'message' => '<b>Not a valid feed (' . $url . ')</b><br /><small>No feed data has been found</small>'
            ];
        }

        if ($this->isTheFeedAlreadyBeingFollowedByUser(Auth::user()->id, $feed->id)) {
            return [
                'status' => 'error',
                'message' => 'This feed is already added to your account. Please refresh the browser if you\'re not seeing the feed. It might take some time before items show up, depending on feed updates.'
            ];
        }

        $userFeed = UserFeed::create([
            'user_id' => Auth::user()->id,
            'feed_id' => $feed->id,
            'color' => $request->get('color'),
            'icon' => $request->get('icon'),
            'auto_pin' => $request->get('autoPin') === "true"
        ]);

        // TODO: Move to a queue
        $feedService->parseFeed($feed);

        return [
            'id' => $userFeed->id,
            'status' => 'success'
        ];
    }

    public function follow(Request $request, ImportService $importService): array
    {
        $feed = Feed::find($request->get('feed_id'));

        if ($this->isTheFeedAlreadyBeingFollowedByUser(Auth::user()->id, $feed->id)) {
            return [
                'status' => 'error',
                'message' => 'This feed is already added to your account. Please refresh the browser if you\'re not seeing the feed. It might take some time before items show up, depending on feed updates.'
            ];
        }

        $userFeed = UserFeed::create([
            'user_id' => Auth::user()->id,
            'feed_id' => $feed->id,
            'color' => $request->get('color'),
            'icon' => $request->get('icon'),
            'auto_pin' => $request->get('autoPin') === "true"
        ]);

        $importService->addOldItemsToUserFeed($userFeed);

        return [
            'id' => $userFeed->id,
            'status' => 'success'
        ];
    }

    public function update(Request $request): array
    {
        $userFeed = UserFeed::where('id', '=', $request->get('id'))
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        $userFeed->color = $request->get('color', $userFeed->color);
        $userFeed->icon = $request->get('icon', $userFeed->icon);
        $userFeed->auto_pin = $request->get('autoPin') === 'on';
        $userFeed->save();

        return [
            'id' => $userFeed->id,
            'status' => 'success'
        ];
    }

    public function remove(Request $request): array
    {
        $userFeed = UserFeed::where('id', '=', $request->get('feedId'))
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        if (!$userFeed) {
            return [
                'status' => 'error',
                'message' => 'Feed not found'
            ];
        }

        $userFeed->delete();

        return [
            'status' => 'success',
            'message' => 'Feed removed'
        ];
    }

    public function disableXFrameNotice(): RedirectResponse
    {
        $user = Auth::user();
        $user->hide_xframe_notice = true;
        $user->save();

        return redirect(route('welcome.index'));
    }

    protected function isTheFeedAlreadyBeingFollowedByUser(int $userId, int $feedId): bool
    {
        return UserFeed::where('user_id', '=', $userId)->where('feed_id', '=', $feedId)->get()->count() > 0;
    }
}
