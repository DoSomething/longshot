var $           = require('jquery');
var classToggle = require('./classToggle');

/**
 * Panels creates interactive sliding panels.
 *
 * @type {Object}
 */
var Panels = {

  /**
   * Initialize the Panels.
   *
   * @param {jQuery} $container The document container.
   * @param {jQuery} $mainNav   The main menu navigation container.
   */
  init: function($container, $mainNav) {
    var $button = $container.find('#button-main-nav');

    // Toggle a state class when the main menu navigation button is clicked.
    $button.on('click', function(event) {
      event.preventDefault();

      classToggle($container, 'is-showing-main-nav');
    });
  }

};

module.exports = Panels;
