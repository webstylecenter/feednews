<?php

namespace App\Console\Commands;

use App\Models\Weather;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateWeatherInfo extends Command
{
    protected $signature = 'weather:update';
    protected $description = 'Updates the locally stored weather information with the latest forecasts';

    private Weather $weather;
    private WeatherService $weatherService;

    public function __construct(Weather $weather, WeatherService $weatherService)
    {
        parent::__construct();
        $this->weather = $weather;
        $this->weatherService = $weatherService;
    }

    public function handle()
    {
        foreach ($this->weather::all() as $weather) {
            $this->line(Carbon::now() . ' ' . $weather->location);
            $this->weatherService->updateWeather($weather, $this);
        }

        $this->line(Carbon::now()
            . ' '
            . 'Finished updating weather forecasts in '
            . (microtime(true) - LARAVEL_START)
            . ' seconds'
        );
    }
}
