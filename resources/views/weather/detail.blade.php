@if($forecast)
<div class="weather--current icon_{{ $forecast->current->type }}">
    {{ number_format($forecast->current->temperature, 0, '.', ',') }}&deg;C
</div>

<div class="weather--forecast">
    @foreach($forecast->upcoming as $weatherDay)
        <div class="weather--forecast-day">
            <div class="weather--icon-small icon_{{ $weatherDay->type }}"></div>
            <div class="max">
                {{ number_format($weatherDay->maxTemperature, 0, '.', ',') }}&deg;C <br />
                {{ \Carbon\Carbon::today()->format('D') }}
            </div>
        </div>
    @endforeach
</div>
@endif
