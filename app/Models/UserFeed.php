<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserFeed extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'user_id',
        'feed_id',
        'icon',
        'color',
        'auto_pin',
    ];

    protected $attributes = [
        'auto_pin' => false
    ];

    protected $casts = [
        'auto_pin' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(UserFeedItem::class);
    }
}
