@if($forecast)
    @if($forecast->current->type === 'partly_cloud')
        <span class="fa fa-cloud"></span>
    @endif

    @if($forecast->current->type === 'thunderstorm')
        <span class="fa fa-bolt"></span>
    @endif

    @if($forecast->current->type === 'rain')
        <span class="fa fa-tint"></span>
    @endif

    @if($forecast->current->type === 'snow')
        <span class="fa fa-snowflake"></span>
    @endif

    @if($forecast->current->type === 'sun')
        @if(\Carbon\Carbon::now()->hour > 6 && \Carbon\Carbon::now()->hour < 21)
            <span class="fa fa-sun"></span>
        @else
            <span class="fa fa-moon"></span>
        @endif
    @endif

    @if($forecast->current->type === 'cloud')
        <span class="fa fa-cloud"></span>
    @endif

    <span class="temperature">
        {{ number_format($forecast->current->temperature, 0, '.', ',') }}&deg;C
    </span>
@endif
