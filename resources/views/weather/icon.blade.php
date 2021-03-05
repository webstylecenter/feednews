@if($forecast)
    @if(strtolower($forecast->current_weather) === \App\Models\Weather::TYPE_CLOUD)
        <span class="fa fa-cloud"></span>
    @endif

    @if(
        strtolower($forecast->current_weather) === \App\Models\Weather::TYPE_SUN
        || strtolower($forecast->current_weather) === \App\Models\Weather::TYPE_CLEAR
    )
        @if(\Carbon\Carbon::now()->hour > 6 && \Carbon\Carbon::now()->hour < 21)
            <span class="fa fa-sun"></span>
        @else
            <span class="fa fa-moon"></span>
        @endif
    @endif

    @if(strtolower($forecast->current_weather) === \App\Models\Weather::TYPE_THUNDER)
        <span class="fa fa-bolt"></span>
    @endif

    @if(strtolower($forecast->current_weather) === \App\Models\Weather::TYPE_RAIN)
        <span class="fa fa-tint"></span>
    @endif

    @if(strtolower($forecast->current_weather) === \App\Models\Weather::TYPE_SNOW)
        <span class="fa fa-snowflake"></span>
    @endif

    <span class="temperature">
        {{ number_format($forecast->current_temp, 0, '.', ',') }}&deg;C
    </span>
@endif
