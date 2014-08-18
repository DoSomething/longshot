var $ = require('jquery');


/**
 * classToggle simply toggles a specified class on an element back and forth.
 *
 * @type {function}
 */
module.exports = function($element, $className) {

  if ($element.hasClass($className)) {
    $element.removeClass($className);
  } else {
    $element.addClass($className);
  }

};
