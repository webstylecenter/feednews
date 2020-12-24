<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getFeedItems(int $limit = 50, $page = null): Collection
    {
        return Auth::user()->feedItems()->orderBy('created_at', 'DESC')->limit($limit)->get();
    }
}
