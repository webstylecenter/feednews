<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feed extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'name',
        'url',
        'category_id',
        'updated_at'
    ];

    public function feedItems(): hasMany
    {
        return $this->hasMany(FeedItem::class);
    }

    public function userFeeds(): hasMany
    {
        return $this->hasMany(UserFeed::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(FeedCategory::class, 'id', 'category_id');
    }
}
