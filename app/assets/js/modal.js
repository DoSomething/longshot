var $           = require('jquery');
var classToggle = require('./classToggle');

/**
 * Modal
 */
var Modal = {

  $modal: $('<div class="modal"><div class="wrapper"></div></div>'),
  $closeButton: $('<button>&#215;</button>'),

  /**
   * Initailize the Modal.
   */
  init: function($container) {
    // console.log(this);
    // console.log(this.$closeButton);

    var $modalContent = $container.find()

    var $modal = this.$modal;
    $modal.append(this.$closeButton);
    $container.append($modal);
  }

};

module.exports = Modal;

// $closeLink $("<a href='#' class='js-close-modal js-modal-generated modal-close-button'>&#215;</a>");
