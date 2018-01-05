var $ = require('jquery');

/**
 * Add confirmation dialog to links with `data-confirm` attribute.
 */
function initialize() {
  $('body').on('click', '*[data-confirm]', function(event) {
    const response = confirm(this.getAttribute('data-confirm'));

    if (!response) {
      event.stopImmediatePropagation();
      return false;
    }

    return response;
  });
}

export default { initialize };
