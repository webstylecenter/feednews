@extends('base')
@php $bodyClass = 'popup' @endphp

@section('title')
    Blocked by X-Frame notice page
@endsection

@section('body')
    <div class="page--homepage">
        <div class="header" style="height: 30vh;">
            @include('widgets.weather')
        </div>

        <style type="text/css">
            a { color: #337dff; }
        </style>

        <div class="mainContent" style="visibility: visible; display: block">
            <nav>
                <span class="js-homepage-showpage active"></span>
            </nav>

            <div class="views" style="background-color:whitesmoke; height:100vh; font-size: 14pt;">
                <div class="view widgets" style="padding: 50px;">
                    <h2>The item you've requested opened in a popup</h2>
                    <p>The feeditem you've clicked cannot be opened within Feednews. A new window has been opened with the requested page.</p>
                    <p>You can install our Chrome-extension that enables all site's to be opened within Feednews.</p>

                    <p>1. <a href="/downloads/chrome-extension.zip">Download Chrome extension</a></p>
                    <p>2. <a href="https://www.cnet.com/how-to/how-to-install-chrome-extensions-manually/" target="_blank">Install the chrome extension</a></p>
                    <p>3. <a href="{{ route('settings.disable.x.frame.notice') }}">Disable this message</a></p>
                </div>

            </div>

        </div>
    </div>
@endsection
