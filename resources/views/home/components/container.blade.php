@php
    $darkTheme = $device->isMobile() && ($hour > 21 or $hour < 8) ? 'darkTheme' : '';
@endphp

<div class="tabs {{ $darkTheme }}">
    <div class="tab tab--recent">
        <aside data-is-mobile="{{ $device->isMobile() }}" data-hideXframe="{{ $user->hide_xframe_notice }}"
               class="feed-list feed-list--type-sidebar {{ $darkTheme }}">
            @include('home.components.newsfeed', ['userFeedItems' => $userFeedItems])
        </aside>
    </div>
    <div class="tab tab--history"></div>
    <div class="tab tab--search">
        <input type="text" name="query" class="search-query js-search-feed" placeholder="Search feed items"/>
        <div class="js-search-list"></div>
    </div>
</div>
<div class="tabBar {{ $darkTheme }}">
    <button class="active" data-open-tab="recent"><span class="fa fa-clock fa-x4"></span> Recent items</button>
    <button data-open-tab="history"><span class="fa fa-history fa-x4"></span> Last opened</button>
    <button data-open-tab="search"><span class="fa fa-search fa-x4"></span> Search</button>
</div>

<div class="content iFramesContainer hide-if-mobile" style="overflow:auto; -webkit-overflow-scrolling: touch;">
    <iframe
        id="welcomeFrame"
        class="content-frame"
        src="{{ route('welcome.index') }}"
        sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-pointer-lock allow-modals"
        allowfullscreen="allowfullscreen"
        mozallowfullscreen="mozallowfullscreen"
        msallowfullscreen="msallowfullscreen"
        oallowfullscreen="oallowfullscreen"
        webkitallowfullscreen="webkitallowfullscreen"
        style="width: 100%; height:100%;"
    ></iframe>
</div>

<div class="urlbar hide">
    <a href="{{ route('welcome.index') }}" target="_blank">{{ route('welcome.index') }}</a>
</div>

<div class="content-close-pip js-close-pip fa fa-window-close"></div>
<div class="content-maximize-pip js-send-from-pip fa fa-window-restore"></div>
