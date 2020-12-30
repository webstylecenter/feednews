<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feed extends Model
{
    use HasTimestamps;

    const COLOR_BLACK = '#000';
    const COLOR_DEFAULT = self::COLOR_BLACK;

    protected $fillable = [
        'name',
        'url',
        'color',
    ];

    protected $attributes = [
        'color' => self::COLOR_DEFAULT
    ];

    public function feedItems(): hasMany
    {
        return $this->hasMany(FeedItem::class);
    }

    public function userFeeds(): hasMany
    {
        return $this->hasMany(UserFeed::class);
    }
}
