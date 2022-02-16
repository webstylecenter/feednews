<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Error extends Model
{
    use HasTimestamps;

    const ERROR_TYPE_MESSAGE = 'message';
    const ERROR_TYPE_WARNING = 'warning';
    const ERROR_TYPE_ERROR = 'error';
    const ERROR_TYPE_FATAL = 'fatal';

    const TYPES = [
        1 => self::ERROR_TYPE_MESSAGE,
        2 => self::ERROR_TYPE_WARNING,
        3 => self::ERROR_TYPE_ERROR,
        4 => self::ERROR_TYPE_FATAL,
    ];

    protected $fillable = [
        'uuid',
        'type',
        'user_id',
        'feed_id',
        'exception',
        'occurrences',
    ];

    public function getType(): string
    {
        return  self::TYPES[$this->type];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }
}
