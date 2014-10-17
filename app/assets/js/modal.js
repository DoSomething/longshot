var $           = require('jquery');
var classToggle = require('./classToggle');
var Slideshow   = require('./slideshow');

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

    var $modalTrigger = $container.find('[data-ui="modal"]');

    // If there's a designated content modal, then lets activate it!
    if ($modalTrigger.length > 0) {

      var $modal = this.$modal;

      var modalType = $modalTrigger.data('modal-type');
      $modal.addClass('modal--' + modalType);

      if (modalType === 'slideshow') {
        // Create a slideshow from the modal content!
        var slideshow = new Slideshow($modalTrigger);

        // Append the slideshow to the modal.
        $modal.find('.wrapper').append(slideshow);
      }

      // Append modal to the container.
      $container.append($modal);



      $modalTrigger.on('click', '.card', function() {  // @TODO: don't use .card use a more generic trigger name as class or data attr.
        console.log(slideshow);

        slideshow.activate();

        // Slideshow.activate($(this));

      //   var $selectedItem = $($slides.get(activeIndex));
      //   classToggle($selectedItem, '-pending');
      //   classToggle($selectedItem, '-viewing');


      //   $modal.addClass('is-toggled');
      //   $body.addClass('has-modal'); // @TODO: save offset top position to return user to it once modal closed!
      });

      this.$closeButton.on('click', function() {
        $modal.removeClass('is-toggled');
        $body.removeClass('has-modal');

      //   var $lastSelectedItem = $($slides.get(activeIndex));
      //   classToggle($lastSelectedItem, '-viewing');
      //   classToggle($lastSelectedItem, '-pending');
      });
    }

  }



};

module.exports = Modal;
