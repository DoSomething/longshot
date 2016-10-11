import formLoader from './form-loader';

var $      = require('jquery');
var Panels = require('./panels');
var Modal  = require('./modal');

// @TODO: may turn the following variables into an module object so it's easier to pass variables around.
var $body      = $('body');
var $container = $('#container');
var $content   = $('#content');
var $mainNav   = $('#main-nav');


Panels.init($container, $mainNav);

// Prevent form double submission
formLoader.initialize();


// If there's a designated content modal, then lets activate it!
var $modals = $container.find('[data-ui="modal"]');

if ($modals.length > 0) {
  var modalList = [];

  $modals.each(function (index, content) {
    modalList[index] = new Modal(content, $container, $body);
  });
}
