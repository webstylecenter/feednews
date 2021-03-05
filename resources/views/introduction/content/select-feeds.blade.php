<h1>Select feeds to follow</h1>

<div class="hide-if-mobile">
    <p>The feeds/sites you add to Feednews will be shared between users. This helps us to offer an interesting list of
       feeds to follow, and helps new users to get started. Click the follow buttons on the feeds that may interest you.</p>
    <p>You can always open settings and unfollow the feeds you no longer want to follow at any time.</p>
</div>

<div class="hide-if-desktop">
    <p>The feeds/sites you add to Feednews will be shared between users. This helps us to offer an interesting list of
        feeds to follow, and helps new users to get started.</p>
    <p>Click on the categories below to expend them into a list of feeds based on that category. Next you can click on the follow buttons on the feeds that may interest you.</p>
    <p>You can always open settings and unfollow the feeds you no longer want to follow at any time.</p>
</div>

<p><button type="button" class="button large js-homepage-showpage" data-page="preferences">Continue</button></p>

<div class="category-to-follow-container">
    @foreach($categories as $category)
        <div class="category-to-follow">
            <h3 class="js-show" data-show-div=".list_{{ $category->id }}">{{ $category->name }}</h3>
            <div class="list">
                <ul class="list_{{ $category->id }}">
                    @foreach($category->feeds as $feed)
                        <li>{{ $feed->name }}
                            <button class="button float-right js-follow-feed fluent-blue" data-feed-id="{{ $feed->id }}">Follow</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    @endforeach
</div>


{{--@php--}}
{{--    $previousCategory = null;--}}
{{--@endphp--}}

{{--@foreach($availableFeeds as $feed)--}}

{{--    @if($feed->category && $previousCategory !== $feed->category->name)--}}

{{--        <h3>{{  $feed->category->name }}</h3>--}}
{{--        @php--}}
{{--            $previousCategory = $feed->category->name;--}}
{{--        @endphp--}}
{{--    @endif--}}


{{--       <p> {{ $feed->name }}--}}
{{--        <button class="button js-follow-feed fluent-blue" data-feed-id="{{ $feed->id }}">Follow</button>--}}
{{--       </p>--}}
{{--@endforeach--}}

