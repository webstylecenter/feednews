<div class="quickjump">
    @foreach($userFeeds as $userFeed)
        <a href="#feedOverview{{ str_slug($userFeed->feed->name) }}">{{ $userFeed->feed->name }}</a>
    @endforeach
</div>

@foreach($userFeeds as $userFeed)
    <div class="widget widget-custom-items" id="feedOverview{{ str_slug($userFeed->feed->name) }}">
        <h2>{{ $userFeed->feed->name }}</h2>
        @foreach($userfeed->items->take(50) as $item)
            <div class="widget-custom-item" data-url="{{ $item->feedItem->url }}">
                {{ $item->feedItem->title }} <span class="description">{{ $item->feedItem->description }}</span>
            </div>
        @endforeach
    </div>
@endforeach
