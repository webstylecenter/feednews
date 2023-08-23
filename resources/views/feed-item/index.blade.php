@extends('multi-tab-view')

@section('headerTitle')
    {{ $feed_title }}
@endsection

@section('tabs')
    <span class="js-homepage-showpage" data-page="feed_item" style="align: left">
        <a href="{{ $feed_item_url }}" target="_blank">{{ $feed_item_title }}</a>
    </span>
@endsection

@section('content')
    <div class="page--feed-item">
        <div class="view active-view feed_item">

            <div class="feed-item-grid">
                <div class="content-left">
                    <p class="publish-date">Published: {{ $feed_item_date }}</p>
                    {!! $feed_item_content !!}
                </div>
                <div class="content-right">
                    <h2>Open the website within FeedNews?</h2>
                    <p>Many websites prevent themselves from being loaded inside another webpage for several security reasons. This also blocks this harmless way of showing websites within a website.</p>

                    <p>You can install the FeedNews Google Chrome extension that removes the x-frame header that prevents other site's from being loaded into Feednews. This extension makes Feednews the tool it wants to be, and work like a sidebar for all your online activty (within feednews afcourse). It also allows you to click on any link and have it add to the Feednews list.</p>

                    <p>1. <a href="/downloads/chrome-extension.zip">Download Chrome extension</a></p>
                    <p>2. <a href="https://www.cnet.com/how-to/how-to-install-chrome-extensions-manually/" target="_blank">Install the chrome extension</a></p>
                    <p>3. <a href="{{ route('settings.disable.x.frame.notice') }}">Disable this message</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
