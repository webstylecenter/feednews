$(function () {
    $(document).on('click', '.js-show', function() {
        let div = $(this).attr('data-show-div');
        $(div).slideToggle();
    });
});
