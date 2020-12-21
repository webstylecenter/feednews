<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedItem extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'title',
        'description',
        'url',
        'pinned'
    ];

    protected $casts = [
        'pinned' => 'boolean'
    ];

    protected $attributes = [
        'pinned' => false
    ];

    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }
}
