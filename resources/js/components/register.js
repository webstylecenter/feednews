$(function () {
    $('.registerBox input[type="submit"]').on('click', function (e) {
        if (!$('.registerBox input[type="checkbox"]').is(':checked')) {
            e.preventDefault();
            showDialog('Cannot create account', 'You must agree with the privacy policy if you want to sign up a FeedNews account');
        }
    });
});
