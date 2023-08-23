<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedItemContent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'feed_item_id',
        'content',
    ];

    public function feedItem(): BelongsTo
    {
        return $this->belongsTo(FeedItem::class);
    }
}
