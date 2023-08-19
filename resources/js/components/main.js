$(function () {

  $('.js-open-add-new-feed-form').on('click', function() {showTabOverlay(route('overlay.add-feed-item'))});
  $('.js-open-add-tag').on('click', function() {
    showTabOverlay(route('overlay.add-tag'))
  });

  $(document).on('blur', '.js-auto-load-meta-data', function (el) {
    // TODO: FIX THIS getUrlMetaData(el);
  });

  $('.widget-note textarea').on('blur', function () {
    saveNote($(this));
  });

  $('.widget-note input').on('blur', function () {
    $(this).parent().find('textarea').trigger('blur');
  });

  setInterval(function () {
    $('.js-update-weahter-icon').load(route('weahter.icon'));
    $('.js-weather-radar').attr('src', 'https://api.buienradar.nl/image/1.0/RadarMapNL?w=500&h=512&time=' + Math.random());
  }, 5 * 60 * 1000);

  $(document).on('click', '.js-open-note', function () {
    $('.widget-note--notes > div').hide();
    $('.note-data-' + $(this).data('note-id')).show();
  })
    .on('click', '.js-remove-note', function () {
      removeNote($(this).data('id'));
    })
    .on('click', '.js-update-weather-icon', function () {
      $('.content-overlay').fadeIn();
      $('.js-show-weather-radar').slideDown();
    })
    .on('click', '.js-show-calendar', function () {
      $('.content-overlay').fadeIn();
      $('.header--bar-calendar-view').slideDown();
    })
    .on('click', '.content-overlay, .feed-list', function () {
      $('.content-overlay').fadeOut();
      $('.js-show-weather-radar').slideUp();
      $('.profileMenu').slideUp();
      $('.header--bar-calendar-view').slideUp();
    });

  $('.specialTxt').each(function () {
    let p1 = 'peter';
    let p3 = 'vdam';
    let p2 = '.nl';
    let p4 = 'mail';
    let p5 = '@';
    let p6 = 'to';
    $(this).html('<a href="' + p4 + p6 + ':' + p1 + p5 + p1 + p3 + p2 + '">' + p1 + p5 + p1 + p3 + p2 + '</a>');
  });

  $('.page--homepage').on('click', function () {
    $('.page--homepage .header').animate({
      height: '30vh'
    }, 500);
    $('.mainContent, .widget').fadeIn();
  });

  $('.js-homepage-showpage').on('click', function () {
    $('.view').slideUp().delay(100);
    $('.mainContent nav span').removeClass('active');
    $('.' + $(this).data('page')).slideDown();
    $(this).addClass('active');
    $('.page--homepage .feeds').load(route('feed.overview'));
  });

  $('.js-toggle-fullscreen').on('dblclick', function () {
    let sidebarWidth = $('.container .feed-list').css('width');
    let headerColor = '#337dff';

    if ($('.content').css('left') !== '0px') {
      sidebarWidth = 0;
      headerColor = '#000';
    }

    $('.header--bar-actions').toggle('slow');
    $('.header--bar').css('backgroundColor', headerColor);
    $('.content').animate({
      left: sidebarWidth
    }, 1000);
  });

  $('.js-other-login-options').on('click', function() {
    $(this).slideUp().then($('.signinBox form').slideDown());
  })
});

function getUrlMetaData(el) {
  let Url = $(el).val();

  if (Url.length > 0) {
    $('.js-overlay-form-container [name="title"]').val("Loading info...");
    $('.js-overlay-form-container [name="description"]').val("");
  }
}

function saveNote($el) {
  let id = $el.attr('data-id');
  let name = $el.parent().find('input').val();
  let position = $el.attr('data-position');
  let note = $el.val();

  $.ajax({
    method: "POST",
    url: route('notes.save'),
    data: {
      id: id,
      position: position,
      name: name,
      note: note
    },
    beforeSend: function () {
      $el.css('color', '#303030');
    }
  })
    .done(function (response) {
      $el.css('color', 'black');
      $('.note-selector-' + id).text(name);
      if (id.length === 0) {
        $el.attr('data-id', response.data.id);
      }
    })
    .fail(function () {
      $el.css('color', 'red');
    });
}

function removeNote(id) {
  if (confirm("Are you sure you want to remove this note?")) {
    $.ajax({
      method: "POST",
      url: route('notes.remove'),
      data: {id: id}
    })
      .done(function () {
        $('.note-selector-' + id).hide();
        $('.note-data-' + id).hide();
      });
  }
}
