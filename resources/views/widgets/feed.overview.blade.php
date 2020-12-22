<div class="quickjump">
    {% for userFeed in userFeeds %}
    {% set feed = userFeed.feed %}
    <a href="#feedOverview{{ feed.name|slugify }}">{{ feed.name }}</a>
    {% endfor %}
</div>

{% for userFeed in userFeeds %}
{% set feed = userFeed.feed %}
<div class="widget widget-custom-items" id="feedOverview{{ feed.name|slugify }}">
    <h2>{{ feed.name }}</h2>
    {% for item in userFeed.items|slice(0, 50) %}
    <div class="widget-custom-item" data-url="{{ item.feedItem.url }}">
        {{ item.feedItem.title }} <span class="description">{{ item.feedItem.description }}</span>
    </div>
    {% endfor %}
</div>
{% endfor %}
