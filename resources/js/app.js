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
new WOW({
    scrollContainer: '.scroll',
    mobile: false
}).init();


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

window.showDialog = function(title, description) {
    $('.dialog .title').html(title);
    $('.dialog .description').html(description);
    $('.dialog').modal({fadeDuration: 100});
}




