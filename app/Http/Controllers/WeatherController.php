<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class WeatherController extends BaseController
{
    public function details(): View
    {
        return view('weather.detail', [
            'bodyClasss' => 'WeahterMobilePage',
            'forecast' => []
        ]);
    }

    public function icon(): View
    {
        return view('weather.icon', [
            'bodyClasss' => 'WeahterMobilePage',
            'forecast' => []
        ]);
    }
}
