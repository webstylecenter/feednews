<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'name',
        'content',
        'position'
    ];

    protected $attributes = [
        'position' => 0
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
