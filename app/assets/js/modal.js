var $           = require('jquery');
var classToggle = require('./classToggle');
var Slideshow   = require('./slideshow');


var Modal = function (element, $container) {
  var _this = this;

  this.$modal = $('<div class="modal"><div class="wrapper"></div></div>');
  this.$closeButton = $('<button class="button button--close">&#215;</button>');

  // Initialize the new Modal.
  this.init(element, $container);

  this.$closeButton.on('click', function () {
    _this.close();
  });
};


Modal.prototype.init = function (element, $container) {
  var _this        = this;
  var $element     = $(element);
  var $modal       = this.$modal;
  var modalType    = $element.data('modal-type');
  var modalContent = '';  // @TODO: add placeholder content?
  
  $modal.addClass('modal--' + modalType);
  $modal.append(this.$closeButton);


  if (modalType === 'slideshow') {
    // Create a slideshow from the modal content!
    modalContent = new Slideshow($element);
    console.log(modalContent);
    
    $modal.find('.wrapper').append(modalContent.$slideshow);
  }
  

  $container.append($modal);

  $element.on('click', '[data-modal="trigger"]', function () {
    // console.log(modalContent);
    modalContent.activate();
    _this.open();
  });
}


Modal.prototype.open = function () {
  this.$modal.addClass('is-toggled');
}


Modal.prototype.close = function () {
  this.$modal.removeClass('is-toggled');
}


module.exports = Modal;
