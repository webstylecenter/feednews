<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFeedItem extends Model
{
    use HasTimestamps;

    protected $guarded = [];

    protected $attributes = [
        'viewed' => false,
        'pinned' => false,
    ];

    protected $casts = [
        'viewed' => 'boolean',
        'pinned' => 'boolean',
        'opened_at' => 'datetime',
        'user_feed_item_updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feedItem(): BelongsTo
    {
        return $this->belongsTo(FeedItem::class);
    }

    public function userFeed(): BelongsTo
    {
        return $this->belongsTo(UserFeed::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
