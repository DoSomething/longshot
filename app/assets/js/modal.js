var $              = require('jquery');
var classToggle    = require('./classToggle');
var modalSlideshow = require('./modalSlideshow');

/**
 * Modal
 */
var Modal = {

  $modal: $('<div class="modal"><div class="wrapper"></div></div>'),
  $closeButton: $('<button class="button button--close">&#215;</button>'),

  /**
   * Initailize the Modal.
   */
  init: function($body, $container) {

    var $modalContent = $container.find('[data-ui="modal"]');

    // console.log($modalContent.length);

    if ($modalContent.length > 0) {

      var $modal = this.$modal;
      $modal.append(this.$closeButton);

      var modalType = $modalContent.data('modal-type');
      $modal.addClass('modal--' + modalType);

      var $slideshow = $('<ul class="slideshow">' + $modalContent.html() + '</ul>');
      var $slides = $slideshow.find('.card').parent();
      $slides.addClass('__slide');

      $modal.find('.wrapper').append($slideshow);

      // Append modal to the container.
      $container.append($modal);


      $modalContent.on('click', '.card', function() {
        console.log($(this).parent().data('slide'));
        $modal.addClass('is-toggled');

        $body.addClass('is-fixed');
      });

      this.$closeButton.on('click', function() {
        $modal.removeClass('is-toggled');
        $body.removeClass('is-fixed');
      });
    }

  }

};

module.exports = Modal;

// $closeLink $("<a href='#' class='js-close-modal js-modal-generated modal-close-button'>&#215;</a>");
