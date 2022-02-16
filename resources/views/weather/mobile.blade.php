@extends('base')

@section('body')
    <div class="WeatherPage">
        <div class="contentbox">
            <img class="js-weather-radar" src="https://api.buienradar.nl/image/1.0/RadarMapNL?w=500&h=512" alt="Weather Radar" />
            <div class="header--bar-weather-radar-overview">
                @include('weather.detail')
            </div>
        </div>
    </div>
@endsection
