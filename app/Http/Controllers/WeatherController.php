<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class WeatherController extends BaseController
{
    public function details(Weather $weather): View
    {
        return view('weather.detail', [
            'bodyClasss' => 'WeahterMobilePage',
            'forecast' => $weather::where('location', '=', 'Eindhoven,NL')->first()
        ]);
    }

    public function icon(Weather $weather): View
    {
        return view('weather.icon', [
            'bodyClasss' => 'WeahterMobilePage',
            'forecast' => $weather::where('location', '=', 'Eindhoven,NL')->first()
        ]);
    }
}
