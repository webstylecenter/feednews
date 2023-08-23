<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FeedItem extends Model
{
    use HasTimestamps, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'feed_id',
        'guid',
        'created_at'
    ];

    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }

    public function feedContent(): HasOne
    {
        return $this->HasOne(FeedItemContent::class);
    }
}
