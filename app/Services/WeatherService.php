<?php

namespace App\Services;

use App\Models\Weather;
use Carbon\Carbon;
use Symfony\Component\Console\Command\Command;

class WeatherService
{
    const API_URL_PREFIX = 'http://api.openweathermap.org/data/2.5/';

    public function updateWeather(Weather $weather, ?Command $command = null): void
    {
        if ($command) {
            $command->info(Carbon::now() . ' ' . $weather->location . ': Fetching weather forecast data...');
        }

        $forecast = $this->fetchForecast($weather->location);

        if ($command) {
            $command->info(Carbon::now() . ' ' . $weather->location . ': Data downloaded');
        }

        if ($forecast['current']) {
            $weather->current_temp = $forecast['current']->main->temp;
            $weather->temp_today_max = $forecast['current']->main->temp_max;
            $weather->temp_today_min = $forecast['current']->main->temp_min;
            $weather->current_weather = $forecast['current']->weather[0]->main;

            if ($command) {
                $command->info(Carbon::now() . ' ' . $weather->location . ': Updated current weather data found...');
            }
        }

        if ($forecast['forecast']) {
            foreach ($forecast['forecast']->list as $day => $dayForecast) {
                if ($day === 0) {
                    continue;
                }

                if ($day >= 5) {
                    break;
                }

                $maxKey = 'temp_in_' . $day . '_days_max';
                $minKey = 'temp_in_' . $day . '_days_min';
                $weatherKey = 'weather_in_' . $day . '_days';

                $weather->{$maxKey} = $dayForecast->temp->max;
                $weather->{$minKey} = $dayForecast->temp->min;
                $weather->{$weatherKey} = $dayForecast->weather[0]->main;
            }

            if ($command) {
                $command->info(Carbon::now() . ' ' . $weather->location . ': Updated forecast weather data found...');
            }
        }

        if (!$forecast['current']&& !$forecast['forecast']) {
            if ($command) {
                $command->error(Carbon::now() . ' ' . $weather->location . ': No data found to be saved!');
            }
            return;
        }

        $weather->save();

        if ($command) {
            $command->info(Carbon::now() . ' ' . $weather->location . ': Saved new weather data...');
        }
    }

    protected function fetchForecast(string $location, string $unit = 'metric'): array
    {
        $currentWeatherUrl = self::API_URL_PREFIX
            . 'weather?q='
            . $location
            . '&APPID='
            . env('OPEN_WEATHER_MAP_KEY')
            . '&units='
            . $unit;

        $forecastUrl = self::API_URL_PREFIX
            . 'forecast/daily/?q='
            . $location
            . '&APPID='
            . env('OPEN_WEATHER_MAP_KEY')
            . '&units='
            . $unit;

        try {
            $currentWeather = json_decode(file_get_contents($currentWeatherUrl));
        } catch (\Throwable $exception) {
            $currentWeather = null;
        }

        try {
            $forecast = json_decode(file_get_contents($forecastUrl));
        } catch (\Throwable $exception) {
            $forecast = null;
        }

        return [
            'current' => $currentWeather,
            'forecast' => $forecast
        ];
    }
}
