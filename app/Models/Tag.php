<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'color'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
