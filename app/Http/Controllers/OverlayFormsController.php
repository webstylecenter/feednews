<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\UserFeedItem;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class OverlayFormsController extends BaseController
{
    public function addFeedItem(): View
    {
        return view('overlay-forms.add-feed-item');
    }

    public function addTag(): View
    {
        return view('overlay-forms.add-tag');
    }

    public function tagFeedItem(int $userFeedItemId): View
    {
        /* @var UserFeedItem $userFeedItem */
        $userFeedItem = UserFeedItem::where('id', '=', $userFeedItemId)->first();

        return view('overlay-forms.tag-feed-item', [
            'id' => $userFeedItemId,
            'title' => $userFeedItem->feedItem->title,
            'description' => $userFeedItem->feedItem->description,
            'color' => $userFeedItem->color,
            'tags' => Tag::where('user_id', '=', Auth::user()->id)->get()
        ]);
    }
}
