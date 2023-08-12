<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TagRepository
{
    private ?User $user;
    public function __construct(private Tag $tag, )
    {
        $this->user = Auth::user();
    }

    public function get(): ?Collection
    {
        return Auth::user()->tags()->get();
    }

    public function add(string $name, string $color): Tag
    {
        if ($this->user === null) {
            throw new AuthorizationException;
        }

        $this->tag->user_id = $this->user->id;
        $this->tag->name = $name;
        $this->tag->color = $color;
        $this->tag->save();

        return $this->tag;
    }

    public function remove(string $name)
    {
        $this->user->tags()->where('name', '=', $name)->delete();
    }
}
