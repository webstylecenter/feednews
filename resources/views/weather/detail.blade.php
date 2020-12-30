@if($forecast)
<div class="weather--current icon_{{ strtolower($forecast->current_weather) }}">
    {{ number_format($forecast->current_temp, 0, '.', ',') }}&deg;C
</div>

<div class="weather--forecast">
    @foreach([1, 2, 3, 4, 5] as $day)
        <div class="weather--forecast-day">
            <div class="weather--icon-small icon_{{ strtolower($forecast->{'weather_in_'.$day.'_days'}) }}"></div>
            <div class="max">
                {{ number_format($forecast->{'temp_in_'.$day.'_days_max'}, 0, '.', ',') }}&deg;C <br />
                <small style="opacity: 0.5">{{ number_format($forecast->{'temp_in_'.$day.'_days_min'}, 0, '.', ',') }}&deg;C</small> <br />
                {{ \Carbon\Carbon::now()->addDays($day)->format('D') }}
            </div>
        </div>
    @endforeach
</div>
@endif
