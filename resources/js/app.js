/* VENDOR */
window.$ = window.jQuery = require('jquery');
require('jquery-ui');
require('jquery-jscroll');
require('jquery-modal');
require('spectrum-colorpicker');
require('jquery-hammerjs');

window.Handlebars = require('handlebars/dist/handlebars.min.js');

import { WOW } from 'wowjs';

import 'handlebars/dist/handlebars.min.js';
import './components/fluent';

/** global: WOW */
window.wow = new WOW({
    scrollContainer: '.scroll',
    mobile: false
});

window.wow.init();

require('./bootstrap');
require('./components/main');
require('./components/clipboard');
require('./components/checklist');
require('./components/newsfeedlist');
require('./components/screensaver');
require('./components/searchbox');
require('./components/settings');
require('./components/welcome');
require('./components/register');
require('./components/tabs');
require('./components/hotlink');
require('./components/introduction');

window.showDialog = function(title, description) {
    $('.dialog .title').html(title);
    $('.dialog .description').html(description);
    $('.dialog').modal({fadeDuration: 100});
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});




