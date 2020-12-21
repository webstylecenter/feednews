<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    const TYPE_CLOUD = 'cloud';
    const TYPE_RAIN = 'rain';
    const TYPE_PARTLY_CLOUD = 'partly_cloud';
    const TYPE_SUN = 'sun';
    const TYPE_SNOW = 'snow';
    const TYPE_THUNDER = 'thunderstorm';
    const TYPE_UNKNOWN = 'unknown';

    // TODO: This model
}
