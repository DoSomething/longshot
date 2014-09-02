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
   * @param {jQuery} $page     The page container.
   * @param {jQuery} $mainNav  The main menu navigation container.
   */
  init: function($page, $mainNav) {
    var $button = $page.find('#button-main-nav');

    // Toggle a state class when the main menu navigation button is clicked.
    $button.on('click', function(event) {
      event.preventDefault();

      classToggle($page, 'is-showing-main-nav');
    });
  }

};

module.exports = Panels;
