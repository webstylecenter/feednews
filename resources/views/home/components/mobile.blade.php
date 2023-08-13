<footer class="footer--bar hide-if-tablet hide-if-desktop">
    <div class="defaultView">
        <div class="grid-container">
            <div class="first">
                <span class="js-open-url footer--bar-weather-icon" data-url="/weather/mobile-page/">@include('weather.icon')</span>
            </div>
            <div class="other">
                <span class="js-open-add-new-feed-form fa fa-file fa-x4"></span>
                <span data-url="{{ route('checklist.index') }}" class="js-open-url fa fa-check fa-x4"></span>
            </div>
        </div>
    </div>

    <div class="pageView">
        <div class="grid-container">
            <div class="first">
                <span class="fa fa-chevron-circle-left js-return"> Back</span>
            </div>
            <div class="other">
                <span class="js-open-new-window fa fa-external-link-alt fa-x4"></span>
                <span class="js-copy-to-clipboard fa fa-share-square fa-x4" data-clipboard-action="copy" data-clipboard-text="{{ env('APP_URL') }}"></span>
            </div>
        </div>
    </div>
</footer>
