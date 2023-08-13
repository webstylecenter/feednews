$(function () {
  $('.js-button-submit-tab-overlay').submit(function(event) {
    event.preventDefault();
  });


  $('.js-button-submit-tab-overlay').on('click', function(el) {

    let actionUrl = $('.js-overlay-form-container').attr('data-action-url');
    let data = $('.js-overlay-form-container').serialize()

    $.post(actionUrl, data, function(response) {
      console.log(response);
      closeOverlay();
    }).fail(function(response) {
      alert(response.responseJSON.message);
    });
  })

  $('.js-close-tab-overlay').on('click', function() {
    closeOverlay();
  })
});

function closeOverlay() {
  $('.tabOverlay').fadeOut();
}
