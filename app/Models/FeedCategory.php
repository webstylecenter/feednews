<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeedCategory extends Model
{
    public function feeds(): HasMany
    {
        return $this->hasMany(Feed::class, 'category_id', 'id');
    }
}
