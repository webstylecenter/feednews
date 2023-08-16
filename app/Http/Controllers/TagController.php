<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\UserFeedItem;
use App\Repositories\TagRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class TagController extends BaseController
{
    public function __construct(private TagRepository $tagRepository)
    {
    }

    public function index(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'total_feed_items' => Auth::user()?->feedItems()?->count(),
            'tags' => $this->tagRepository->get()->toArray()
        ]);
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'color' => ['required', 'min:4', 'max:7'],
        ]);

        $color = str_replace('#', '', $request->get('color'));
        $this->tagRepository->add($request->get('name'), $color);

        return new JsonResponse(['status' => 'success']);
    }

    public function tagUserFeedItem(Request $request): JsonResponse
    {
        $request->validate([
            'user-feed-item-id' => ['required', 'integer'],
            'tag' => ['required', 'integer'],
        ]);

        /* @var UserFeedItem $userFeedItem */
        $userFeedItem = UserFeedItem::where('id', '=', $request->get('user-feed-item-id'))->first();
        $tag = Tag::where('id', '=', $request->get('tag'))->first();

        if ($userFeedItem->user_id !== Auth::user()->id || $tag->user_id !== Auth::user()->id) {
            throw new AuthorizationException();
        }

        $userFeedItem->tag_id = $tag->id;
        $userFeedItem->save();

        return new JsonResponse(['status' => 'success']);
    }

    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        $this->tagRepository->remove($request->get('name'));

        return new JsonResponse(['status' => 'success']);
    }
}
