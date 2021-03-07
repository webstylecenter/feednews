@php
    $values = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
@endphp
<div class="content-left">
    <div class="form">
        <h1>Add RSS Feed</h1>
        <p>
            <input type="text" name="url" value="" placeholder="Insert RSS feed url" /><br />
            or
            <input class="websiteurl" type="text" name="website" value="" placeholder="Insert website url" /><br />

            <input type="text" name="icon" value="" placeholder="FontAwesome icon (optional)" /><br />
            <input type="checkbox" name="autoPin" value="1" id="autoPin"/><label for="autoPin">Automatically pin new items</label><br />
            <input type="text" name="color" class="spectrum" value="#{{ $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] }}" placeholder="Insert RGB without the #" /><br />
            <input type="submit" value="Add" class="js-settings-add-feed fluent-blue" />
        </p>
    </div>

    @if($availableFeeds)
        <div class="addUserFeeds">
            <h2>Ready to follow</h2>
            <div class="refreshNotice">Refresh the page when you're ready!</div>
            <table>
                <tbody>
                @php
                    $previousCategory = null;
                @endphp
                @foreach($availableFeeds as $feed)

                    @if($feed->category && $previousCategory !== $feed->category->name)
                            </tbody>
                        </table>

                        <h3>{{  $feed->category->name }}</h3>
                        <table>
                            <tbody>

                        @php
                            $previousCategory = $feed->category->name;
                        @endphp
                    @endif

                    <tr>
                        <td>{{ $feed->name }}</td>
                        <td>{{ $feed->category->name ?? 'other' }}</td>
                        <td><button class="button js-follow-feed fluent-blue" data-feed-id="{{ $feed->id }}">Follow</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<div class="content-right">
    <div class="userFeeds">
        <h1>Currently following:</h1>
        @if($userFeeds)
            <table>
                <tbody>
                @foreach($userFeeds as $feed)
                    <tr data-feed-id="{{ $feed->id }}" data-feed-name="{{ $feed->feed->name }}">
                        <td>
                            <div class="feedColor">
                                <input type="text" class="spectrum js-update-feed-color" name="color" value="{{ $feed->color }}" />
                            </div>
                        </td>
                        <td class="feedName">
                            {{ $feed->feed->name }}
                        </td>
                        <td class="feedIcon" data-balloon="Click to set feed icon" data-balloon-pos="left">
                            <span class="fa fa-{{ $feed->icon === '' ? 'plus emptyIcon' : $feed->icon }} js-open-icon-selector"></span>
                        </td>
                        <td class="feedUrl hide-if-mobile">
                            <a href="{{ $feed->feed->url }}" target="_blank">{{ $feed->feed->url }}</a>
                        </td>
                        <td class="feedIcon hide-if-mobile">
                            <input data-balloon="Automaticly pin new items" data-balloon-pos="left" title="Autopin new items" class="js-update-auto-pin" type="checkbox" value="1" @if($feed->auto_pin)checked="checked"@endif />
                        </td>
{{--                        <td class="feedAmount hide-if-mobile">--}}
{{--                            {{ $feed->items->count() }}--}}
{{--                        </td>--}}
                        <td class="feedActions">
                            <button class="js-settings-remove-feed fa fa-trash"></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Add your first RSS Feed to have it listed here</p>
        @endif
    </div>
</div>
