var $           = require('jquery');
var classToggle = require('./classToggle');
var Slideshow   = require('./slideshow');


var Modal = function (content, $container) {
  console.log('[#1 Modal] Create Modal from constructor function.');

  this.$modal       = $('<div class="modal"><div class="wrapper"></div></div>');
  this.$closeButton = $('<button class="button button--close">&#215;</button>');
  this.$content     = $(content);
  this.modalType    = this.$content.data('modal-type');
  this.modalContent = '<p>No content available!</p>';

  console.log(this);

  this.init($container);

};


Modal.prototype.init = function ($container) {
  console.log('[#2 Modal] Initialize the newly created Modal.');

  var _this = this;

  this.$modal.addClass('modal--' + this.modalType);
  this.$modal.append(this.$closeButton);

  if (this.modalType === 'slideshow') {
    this.modalContent = new Slideshow(this.$content);
    
    this.$modal.find('.wrapper').append(this.modalContent.$slideshow);
  }

  $container.append(this.$modal);

  // Opening Modal
  this.$content.on('click', '[data-modal="trigger"]', function () {
    var $this = $(this);

    _this.open($this);
  });

  // Closing Modal
  this.$closeButton.on('click', function () {
    _this.close();
  });

}


Modal.prototype.open = function ($selection) {
  console.log('[#3 Modal] Open the Modal.');

  if (this.modalType === 'slideshow') {
    this.modalContent.activate($selection);
  }

  this.$modal.addClass('is-toggled');

}


Modal.prototype.close = function () {
  console.log('[#4 Modal] Open the Modal.');

  this.$modal.removeClass('is-toggled');

  if (this.modalType === 'slideshow') {
    this.modalContent.reset();
  }

}


module.exports = Modal;
