var $      = require('jquery');
var Panels = require('./panels');


var $body    = $('body');
var $page    = $('#page');
var $main    = $('main');
var $mainNav = $('#main-nav');


Panels.init($page, $mainNav);
