var $           = require('jquery');
var classToggle = require('./classToggle');
var Slideshow   = require('./slideshow');


var Modal = function (content, $container, $body) {

  this.$modal         = $('<div class="modal"><div class="wrapper"></div></div>');
  this.$closeButton   = $('<button class="button button--close"><span class="icon" data-icon="&#xd7"></span></button>');
  this.$content       = $(content);
  this.modalType      = this.$content.data('modal-type');
  this.modalContent   = '<p>No content available!</p>';
  this.document       = $(document);
  this.scrollPosition = 0;

  this.init($container, $body);

};


Modal.prototype.init = function ($container, $body) {

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

    _this.open($this, $body);
  });

  // Closing Modal
  this.$closeButton.on('click', function () {
    _this.close($body);
  });

}


Modal.prototype.open = function ($selection, $body) {

  if (this.modalType === 'slideshow') {
    this.modalContent.activate($selection);
  }

  this.$modal.addClass('is-toggled');
  this.scrollPosition = this.document.scrollTop();
  $body.addClass('has-modal'); // @TODO: save offset top position to return user to it once modal closed!

}


Modal.prototype.close = function ($body) {

  $body.removeClass('has-modal');
  this.document.scrollTop(this.scrollPosition);

  this.$modal.removeClass('is-toggled');

  if (this.modalType === 'slideshow') {
    this.modalContent.reset();
  }

}


module.exports = Modal;
