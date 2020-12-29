<?php

namespace App\Http\Controllers;

use App\Models\FeedItem;
use App\Models\Meta;
use App\Models\UserFeedItem;
use App\Services\MetaService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class FeedController extends BaseController
{
    public function add(Request $request, FeedItem $feedItem, UserFeedItem $userFeedItem, MetaService $metaService, Meta $meta)
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

    public function chromeImport()
    {
        // TODO: Add functionality to method
    }

    public function getMetaData()
    {
        // TODO: Add functionality to method
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

    public function refresh()
    {
        // TODO: Add functionality to method
    }

    public function loadMore(int $page)
    {
        // TODO: Add functionality to method
    }

    public function search()
    {
        // TODO: Add functionality to method
    }

    public function overview()
    {
        // TODO: Add functionality to method
    }

    public function checkForXFrameHeader()
    {
        // TODO: Add functionality to method
    }

    public function popupOpened()
    {
        // TODO: Add functionality to method
    }

    public function openSharedItem()
    {
        // TODO: Add functionality to method
    }

    public function setOpenedItem()
    {
        // TODO: Add functionality to method
    }

    public function getOpenedItems()
    {
        // TODO: Add functionality to method
    }

    public function createFeedItem()
    {
        // TODO: Add functionality to method
    }
}
