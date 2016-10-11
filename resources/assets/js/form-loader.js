var $ = require('jquery');

/**
 * Add a 'loading' indicator and prevent double
 * form submission from over-eager clickers.
 */
function initialize() {
  $(document.body).on('submit', 'form', function() {
    const submits = this.querySelectorAll('input[type="submit"], button[type="submit"]');

    Array.prototype.forEach.call(submits, function(button) {
      button.setAttribute('readonly', 'readonly');
    });
  });
}

export default { initialize };