$(function () {
    $('.js-search-feed').on('keyup', function () {
        searchFeeds($(this).val());
    })
});


var searchFeeds = function (searchQuery) {
    $('.js-search-list').html('').slideDown();

    if (searchQuery === '' || searchQuery.substring(0, 4) === 'http') {
        return;
    }

    $.getJSON(route('feed.search', {query: searchQuery}), function (data) {
        if (data.status !== 'success') {
            return;
        }

        let source = $('#js-feed-item-template').html();
        /** global: Handlebars */
        let template = Handlebars.compile(source);

        $('.js-search-list').html(template({
            feedItems: data.data,
            query: searchQuery
        }));

        $('.tab--search .js-action-feed-list-swipe').each(function () {
            var mc = new Hammer(this);
            var that = $(this);
            mc.on('swiperight', function(ev) {
                $(that).find('.pin').trigger('click');
            });
        });

        window.wow.sync();
    });
}
