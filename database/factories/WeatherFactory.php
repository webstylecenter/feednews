<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WeatherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Weather::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'location' => $this->faker->city . ',' . $this->faker->countryCode,
            'current_temp' => rand(-200, 400) / 10,
            'current_weather' => Weather::WEATHER_TYPES[array_rand(Weather::WEATHER_TYPES)],
            'temp_today_max' => rand(-100, 400) / 10,
            'temp_today_min' => rand(-200, 200) / 10,
            'temp_in_1_days_max' => rand(-100, 400) / 10,
            'temp_in_1_days_min' => rand(-200, 200) / 10,
            'temp_in_2_days_max' => rand(-100, 400) / 10,
            'temp_in_2_days_min' => rand(-200, 200) / 10,
            'temp_in_3_days_max' => rand(-100, 400) / 10,
            'temp_in_3_days_min' => rand(-200, 200) / 10,
            'temp_in_4_days_max' => rand(-100, 400) / 10,
            'temp_in_4_days_min' => rand(-200, 200) / 10,
            'temp_in_5_days_min' => rand(-200, 200) / 10,
            'weather_in_1_days' => Weather::WEATHER_TYPES[array_rand(Weather::WEATHER_TYPES)],
            'weather_in_2_days' => Weather::WEATHER_TYPES[array_rand(Weather::WEATHER_TYPES)],
            'weather_in_3_days' => Weather::WEATHER_TYPES[array_rand(Weather::WEATHER_TYPES)],
            'weather_in_4_days' => Weather::WEATHER_TYPES[array_rand(Weather::WEATHER_TYPES)],
            'weather_in_5_days' => Weather::WEATHER_TYPES[array_rand(Weather::WEATHER_TYPES)]
        ];
    }
}
