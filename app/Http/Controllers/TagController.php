<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

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
            'color' => ['required', 'min:3', 'max:6'],
        ]);

        $this->tagRepository->add($request->get('name'), $request->get('color'));

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
