<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'color'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userFeedItems(): HasMany
    {
        return $this->hasMany(UserFeedItem::class, 'tag_id', 'id');
    }

    public function count(): int
    {
        return $this->userFeedItems()->count();
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'color' => $this->color,
            'count' => $this->count()
        ];
    }
}
