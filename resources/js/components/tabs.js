$(function () {
  $('.tabBar button').on('click', function() {
    switchToTab(this);
  })

 loadTags();
});

function switchToTab(el) {
  let name = $(el).data('open-tab');
  $('.tabBar button').removeClass('active');
  $(el).addClass('active');
  $('.tabs .tab').hide();
  $('.tab--' + name).show();

  if (name == 'history') {
      loadHistory();
  }
}

function loadHistory() {
  let source = $('#js-feed-item-template').html();
  /** global: Handlebars */
  let template = Handlebars.compile(source);

  $.getJSON(route('feed.opened.items'), function (data) {
    if (data.status !== 'success') {
      return;
    }

    $('.tab--history').html(template({
      feedItems: data.items
    }));

    $('.tab--history .js-action-feed-list-swipe').each(function () {
      var mc = new Hammer(this);
      var that = $(this);
      mc.on('swiperight', function(ev) {
          $(that).find('.pin').trigger('click');
      });
    });

    window.wow.sync();
  });
}

function loadTags()
{
  $.getJSON(route('tag.index'), function (data) {
    if (data.status !== 'success') {
      return;
    }

    $(data.tags).each(function(key, tag) {

      $('.tags select').append($('<option>', {
        value: tag.name,
        text: tag.name + ' (' + tag.count + ' items)'
      }));
    });

  });
}
