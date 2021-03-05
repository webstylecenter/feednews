<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weather extends Model
{
    use HasTimestamps, HasFactory;

    protected $table = 'weather_forecasts';

    const TYPE_CLOUD = 'clouds';
    const TYPE_RAIN = 'rain';
    const TYPE_PARTLY_CLOUD = 'partly_cloud';
    const TYPE_SUN = 'sun';
    const TYPE_CLEAR = 'clear';
    const TYPE_SNOW = 'snow';
    const TYPE_THUNDER = 'thunderstorm';
    const TYPE_UNKNOWN = 'unknown';

    const WEATHER_TYPES = [
        self::TYPE_CLOUD,
        self::TYPE_RAIN,
        self::TYPE_PARTLY_CLOUD,
        self::TYPE_SUN,
        self::TYPE_CLEAR,
        self::TYPE_SNOW,
        self::TYPE_THUNDER
    ];

    protected $fillable = [
        'location',
        'current_temp',
        'current_weather',
        'temp_today_max',
        'temp_today_min',
        'temp_in_1_days_max',
        'temp_in_1_days_min',
        'temp_in_2_days_max',
        'temp_in_2_days_min',
        'temp_in_3_days_max',
        'temp_in_3_days_min',
        'temp_in_4_days_max',
        'temp_in_4_days_min',
        'temp_in_5_days_min',
        'weather_in_1_days',
        'weather_in_2_days',
        'weather_in_3_days',
        'weather_in_4_days',
        'weather_in_5_days',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
