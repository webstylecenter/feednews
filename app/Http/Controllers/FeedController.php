<?php

namespace App\Http\Controllers;

use App\Models\UserFeedItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FeedController extends BaseController
{
    public function add()
    {
        // TODO: Add functionality to method
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
