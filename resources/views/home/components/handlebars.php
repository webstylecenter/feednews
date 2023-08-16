<script id="js-feed-item-template" type="text/x-handlebars-template">
    {{#each feedItems}}
    <div class="feed-list-item js-action-feed-list-click js-action-feed-list-swipe fluent {{#if pinned}}feed-list-item--state-pinned{{/if}}"
                     data-url="{{url}}" data-share-id="{{shareId}}" data-id="{{ id }}" style="border-left-color:{{color}};">
    <div data-balloon="Pin item" data-balloon-pos="left" class="pin" data-pin-id="{{id}}"><span class="fa fa-thumbtack"></span></div>

    <div data-feed-item-id="{{ id }}" class="js-tag-feed-item feed-item-action-icons hide-if-mobile
        {{#if item.tag !== null }} style="visibility: visible; color:#{{item.tag.color}}" title="{{item.tag.name}}" {{/if}}">
        <span class="fa fa-tag"></span>
    </div>

    <div data-balloon="Open in popup" data-balloon-pos="left" class="pip feed-item-action-icons hide-if-mobile"><span class="fa fa-window-restore"></span></div>

    {{#if feedIcon }}
    <div class="feed-icon" style="background-color:{{ feedColor }}">
            <span class="fa fa-{{ feedIcon }}"></span>
        </div>
    {{/if}}
    <p class="title">{{title}}</p>
        <p class="description">{{description}}</p>
    </div>
    {{/each}}
</script>
