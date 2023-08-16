<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TagRepository
{
    public function get(): ?Collection
    {
        return Auth::user()->tags()->get();
    }

    public function add(string $name, string $color): Tag
    {
        if (Auth::user() === null) {
            throw new AuthorizationException;
        }

        $tag = new Tag();
        $tag->user_id = Auth::user()->id;
        $tag->name = $name;
        $tag->color = $color;
        $tag->save();

        return $tag;
    }

    public function remove(string $name)
    {
        Auth::user()->tags()->where('name', '=', $name)->delete();
    }
}
