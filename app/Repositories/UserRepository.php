<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getFeedItems(int $limit = 50, $page = null): Collection
    {
        return Auth::user()
            ->feedItems()
            ->orderBy('pinned', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->skip($page * $limit)
            ->take($limit)
            ->get();
    }
}
