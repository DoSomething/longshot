var $      = require('jquery');
var Panels = require('./panels');
var Modal  = require('./modal');


var $body      = $('body');
var $container = $('#container');
var $content   = $('#content');
var $mainNav   = $('#main-nav');


Panels.init($container, $mainNav);
Modal.init($container);
