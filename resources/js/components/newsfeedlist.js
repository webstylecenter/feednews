$(function () {
    // Endless scroll
    $('.feed-list').jscroll({
        padding: 150,
        nextSelector: 'a.jscroll-next:last',
        contentSelector: '.feed-list-item',
        callback: function () {
            $('.jscroll-added:last-of-type .js-action-feed-list-swipe').each(function() {
                var mc = new Hammer(this);
                var that = $(this);
                mc.on('swiperight', function() {
                    $(that).find('.pin').trigger('click');
                });
            });
        }
    });

    $('.header--bar').each(function () {
        var mc = new Hammer(this);
        mc.on('swiperight', function() {
            $('.js-return').trigger('click');
        });
        mc.on('swipeleft', function(ev) {
          $(that).find('.js-tag-feed-item').trigger('click');
        });
    });

    $(document)
        .on('click', '.js-open-url', function () {
            $('.header--bar, footer').css('backgroundColor', '#337dff');
            openPage($(this).data('url') !== '' ? $(this).data('url') : route('feed.no.url'), $(this).data('share-id'), $(this).data('id'));
        })
        .on('click', '.js-action-feed-list-click', function () {
            $(this).addClass('animated pulse feed-list-item--state-selected');
            $('.feed-list-item').removeClass('feed-list-item--state-selected');
            $('.header--bar, footer').css('backgroundColor', $(this).css('borderLeftColor'));
            openPage($(this).data('url') !== '' ? $(this).data('url') : route('feed.no.url'), $(this).data('share-id'), $(this).data('id'));
        })
        .on('click', '.js-return', function (e) {
            e.preventDefault();
            $('.header--bar, footer').css('backgroundColor', '#337dff');
            $('.content iframe').prop('src', route('welcome.index'));
            $('.content').addClass('hide-if-mobile');
            $('aside').removeClass('hide-if-mobile');
            $('.Homepage').removeClass('pageOpen');
            $('footer .pageView').hide();
            $('footer .defaultView').show();
        })
        .on('click', '.pin', function (e) {
            e.stopImmediatePropagation();
            var that = this;
            $.post(route('feed.pin'), {id: $(this).data('pin-id')}, function (response) {
                if (response.status !== 'success') {
                    showDialog('Error while pinning', 'Pin status cannot be changed right now. Bad connection?');
                    return;
                }

                $(that).parent().addClass('animated shake');
                if (response.current_state === true) {
                    $(that).parent().addClass('feed-list-item--state-pinned');
                } else {
                    $(that).parent().removeClass('feed-list-item--state-pinned');
                }

            }, 'json');
        })
        .on('click', '.pip', function (e) {
            e.stopImmediatePropagation();
            openInPictureInPicture(parseUrl($(this).parent().data('url'), false));
        })
        .on('click', '.js-tag-feed-item', function(e) {
          e.stopImmediatePropagation();
          showTabOverlay(route('overlay.tag-feed-item', {'id': $(this).attr('data-feed-item-id')}));
        })
        .on('click', '.js-close-pip', function () {
            $('.content-pictureInPictureFrame').remove();
            $('.content-close-pip').hide();
            $('.content-maximize-pip').hide();
        })
        .on('click', '.js-modal-trigger', function () {
            $($(this).data('modal-target')).modal({fadeDuration: 100});
        })
        .on('click', '.js-open-new-window', function () {
            window.open($('.urlbar a').attr('href'));
        })
        .on('click', '.js-visbility-toggle', function () {
            $($(this).data('target')).toggle();
        })
        .on('click', '.js-send-to-pip', function () {
            switchToPicutreInPicture();
        })
        .on('click', '.js-send-from-pip', function () {
            switchFromPictureInPicture();
        })
        .on('click', '.js-open-profile-menu', function() {
            $('.profileMenu').slideToggle();
            $('.content-overlay').fadeIn();
        })
        .on('click', '.profileMenu', function() {
            $('.profileMenu').slideUp();
            $('.content-overlay').fadeOut();
        })
      .on('click', '.js-show-hidden-pinned-items', function() {
          $('.hidden-feed-items').hide();
          $('.hidden-pinned-item').fadeIn();
      })
      .on('click', '.js-refresh-feed-items', function() {
          $('aside').scrollTop(0);
          requestNewFeedItems();
      })
      .on('change', '.js-action-filter-by-tag', function(el) {
        let tagId = $("option:selected", this).val();

        if (tagId === '') {
          $('.action-filter-by-tag-results').html('');
          $('aside').show();
        } else {
          $('aside').hide();
          filterByTag(tagId);
        }
      })
    ;

    $('.js-action-feed-list-swipe').each(function () {
        var mc = new Hammer(this);
        var that = $(this);
        mc.on('swiperight', function(ev) {
            $(that).find('.pin').trigger('click');
        });
        mc.on('swipeleft', function(ev) {
          $(that).find('.js-tag-feed-item').trigger('click');
        });
    });

    $('.content-close-pip, .content-maximize-pip').hide();
});

window.openPage = (url, shareId, userFeedItemId) => {
    let isMobile = $('.feed-list--type-sidebar').attr('data-is-mobile');
    let disableXcheck = $('.feed-list--type-sidebar').attr('data-hideXframe');
    $('.profileMenu').slideUp();

    if (isMobile === "1") {
        hasXFrameHeader(url, shareId);
    } else {
        if (disableXcheck === "1") {
            openInFrame(url, shareId);
        } else {
            hasXFrameHeader(url, shareId);
        }
    }

    setItemToOpened(userFeedItemId);
}

function hasXFrameHeader(url, shareId) {
    $.post(route('feed.check.x.frame.header'), {url: url}).then(function (data) {
        if (data.found === true) {
            openInNewWindow(url);
        } else {
            openInFrame(url, shareId)
        }
    });
}

function setItemToOpened(userFeedItemId) {
    $.post(route('feed.set.opened.item'), {userFeedItemId: userFeedItemId});
}

function openInFrame(url, shareId) {
    $('.content').removeClass('hide-if-mobile');
    $('aside').addClass('hide-if-mobile');
    $('.Homepage').addClass('pageOpen');
    $('footer .defaultView').hide();
    $('footer .pageView').show();
    $('.content-frame').attr('src', parseUrl(url, true));
    $('.urlbar a').text('https://' + window.location.hostname + '/share/' + shareId).attr('href', url);
    $('.js-copy-to-clipboard').attr('data-clipboard-text', 'https://' + window.location.hostname + '/share/' + shareId);
}

function openInNewWindow(url) {
    window.open(url);

    if (!$('.feed-list--type-sidebar').attr('data-is-mobile')) {
        $('.content-frame').attr('src', route('feed.popup.opened'));
    }
}

function switchToPicutreInPicture() {
    $('.content-pictureInPictureFrame').remove();
    $('.content-frame').addClass('content-pictureInPictureFrame').removeClass('content-frame');
    createIframe('content-frame', '');
}

function openInPictureInPicture(url) {
    $('.content-pictureInPictureFrame').remove();
    createIframe('content-pictureInPictureFrame', url);
}

function switchFromPictureInPicture() {
    $('.content-frame').remove();
    $('.content-pictureInPictureFrame').addClass('content-frame').removeClass('content-pictureInPictureFrame');
    $('.content-close-pip').hide();
    $('.content-maximize-pip').hide();
}

function createIframe(className, url) {
    var newFrame = document.createElement('iframe');
    newFrame.className = className;

    if (location.protocol === 'https:') {
        url = url.replace('http://', 'https://');
    }

    newFrame.src = url;
    $(newFrame).attr('sandbox', 'allow-scripts allow-same-origin allow-forms allow-popups allow-pointer-lock allow-modals');
    $(newFrame).attr('allowfullscreen', 'allowfullscreen');
    $('.iFramesContainer').append(newFrame);
    $('.content-close-pip').show();
    $('.content-maximize-pip').show();
}

function parseUrl(url, changeColors) {

    var videoId = url.replace('https://www.youtube.com/watch?v=', '');
    if (url !== videoId) {
        if (changeColors) {
            $('.feed-list, .tabBar, .tabs, .tabOverlay').addClass('darkTheme', 2000, 'easeInOutQuad');
        }
        $('.header--bar, footer').css('backgroundColor', '#1a1a1a');
        return 'https://www.youtube.com/embed/' + videoId + '?autoplay=true';
    }

    if (changeColors) {
        $('.feed-list, .tabBar, .tabs, .tabOverlay').removeClass('darkTheme', '', 2000, 'easeInOutQuad');
    }

    if (location.protocol === 'https:') {
        url = url.replace('http://', 'https://');
    }

    return url;
}

function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function (m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function filterByTag(tagId)
{
  let source = $('#js-feed-item-template').html();
  /** global: Handlebars */
  let template = Handlebars.compile(source);

  $.getJSON(route('feed.tag', {tag: tagId}), function (data) {
    if (data.status !== 'success') {
      return;
    }

    $('.action-filter-by-tag-results').html(template({
      feedItems: data.items
    }));

    $('.tab--recent-tag-filtered .js-action-feed-list-swipe').each(function () {
      var mc = new Hammer(this);
      var that = $(this);
      mc.on('swiperight', function(ev) {
        $(that).find('.pin').trigger('click');
      });
      mc.on('swipeleft', function(ev) {
        $(that).find('.js-tag-feed-item').trigger('click');
      });
    });

    window.wow.sync();
  });
}

