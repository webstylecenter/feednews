@php
    $hadNewItems = false;
    $showedEarlierTodayMessage = false;
    $hadYesterdayBefore = false;
    $hadHiddenPinnedItem = false;
    $shownPinnedItems = 0;
@endphp

@if(!$userFeedItems && !$searchQueryString)
<div class="noFeedItems">
    @include('home.welcome-text')
</div>
@endif

@foreach($userFeedItems as $item)
    @php
        $hidePinnedItem = false;
    @endphp

    @if(\Carbon\Carbon::now()->subDays(14)->format('Y-m-d') > $item->updated_at->format('Y-m-d') || $loop->index > 5)
        @php
            $hidePinnedItem = true;
        @endphp

        @if(!$hadHiddenPinnedItem)
            <div class="hidden-feed-items js-show-hidden-pinned-items">
                Show old pinned items
            </div>
        @endif

        @php
            $hadHiddenPinnedItem = true;
        @endphp
    @endif

    @if(!$item->viewed)
        @php
            $hadNewItems = true;
        @endphp
    @endif

    @if($item->viewed && $hadNewItems && !$showedEarlierTodayMessage && $loop->index > 1)
        <div class="feed-list--separator">
            Earlier today
        </div>

        @php
            $showedEarlierTodayMessage = true;
        @endphp

    @elseif($item->viewed && !$hadYesterdayBefore && $item->created_at->format('Y-m-d') == \Carbon\Carbon::yesterday()->format('Y-m-d') && $loop->index > 1)
        <div class="feed-list--separator">
            Yesterday
        </div>

        @php
            $hadYesterdayBefore = true;
        @endphp
    @endif

    <div class="
        feed-list-item
        js-action-feed-list-click
        js-action-feed-list-swipe
        fluent
        @if(!$item->viewed) feed-list-item--state-new @endif
        @if($item->pinned) feed-list-item--state-pinned @endif
        @if($item->icon) hasIcon @endif
        @if($item->pinned && $hidePinnedItem) hidden-pinned-item @endif
        "
         data-url="{{ $item->url }}"
         data-share-id="{{ $item->name ? Str::slug($item->name) : Str::slug(Auth::user()->name) }}/{{ $item->id }}/"
         data-id="{{ $item->id }}"
         style="border-left-color:{{ $item->color ?? '#f0d714' }};"
    >
        <div data-balloon="Pin item" data-balloon-pos="left" class="pin" data-pin-id="{{ $item->id }}">
            <span class="fa fa-thumbtack"></span>
        </div>
        <div data-balloon="Open in popup" data-balloon-pos="left" class="pip hide-if-mobile">
            <span class="fa fa-window-restore"></span>
        </div>

        @if($item->icon)
            <div class="feed-icon" style="background-color:{{ $item->color }}">
                <span class="fa fa-{{ $item->icon }}"></span>
            </div>
        @endif
        <p class="title ">{{ strip_tags($item->title) }}</p>
        <p class="description">
            @if($item->description)
                {{ substr($item->description, 0, 120) }}
            @else
                {{ $item->name ? $item->name : Auth::user()->name }}
            @endif
        </p>
    </div>
@endforeach

@if($userFeedItems && isset($nextPageNumber))
    <a href="{{ route('feed.load.more', [
        'page' => $nextPageNumber
    ]) }}" class="feed-list-item jscroll-next">Next page</a>
@endif
