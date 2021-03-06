@extends('multi-tab-view')

@section('headerTitle')
    Feedback
@endsection

@section('tabs')
    <span class="js-homepage-showpage active" data-page="send">Send feedback</span>
    <span class="js-homepage-showpage" data-page="receive">Feedback response</span>
@endsection

@section('content')
    <div class="page--settings">
        <div class="view active-view send">
            <h1>Leave feedback</h1>
            <p>Please send me an email to <a href="mailto:peter@petervdam.nl">peter@petervdam.nl</a> with comments, suggestions, bug reports or anything you would like to say about FeedNews. When possible, your request will be my top priority.</p>

            <p>If you are a programmer yourself, feel free to contribute by adding new stuff or fixing broken stuff through <a target="_blank" href="https://github.com/webstylecenter/feednews/">Github</a>. If you send me a pull request, and it's a nice addition, I will make it available to anyone. Together we can make FeedNews the best tool out there.</p>

            <p>If you don't want to send a mail, but still leave feedback. A feedback form will be available soon. So please check back!</p>
        </div>
        <div class="view receive">
            <h1>Feedback response</h1>
            <p>We haven't heard feedback from you, or haven't responded yet. Please check back later.</p>
        </div>
    </div>
@endsection
