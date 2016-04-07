(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function (global){
var $ = (typeof window !== "undefined" ? window['$'] : typeof global !== "undefined" ? global['$'] : null);

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

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}],2:[function(require,module,exports){
(function (global){
var $      = (typeof window !== "undefined" ? window['$'] : typeof global !== "undefined" ? global['$'] : null);
var Panels = require('./panels');
var Modal  = require('./modal');

// @TODO: may turn the following variables into an module object so it's easier to pass variables around.
var $body      = $('body');
var $container = $('#container');
var $content   = $('#content');
var $mainNav   = $('#main-nav');


Panels.init($container, $mainNav);


// If there's a designated content modal, then lets activate it!
var $modals = $container.find('[data-ui="modal"]');

if ($modals.length > 0) {
  var modalList = [];

  $modals.each(function (index, content) {
    modalList[index] = new Modal(content, $container, $body);
  });
}

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{"./modal":3,"./panels":4}],3:[function(require,module,exports){
(function (global){
var $           = (typeof window !== "undefined" ? window['$'] : typeof global !== "undefined" ? global['$'] : null);
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

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{"./classToggle":1,"./slideshow":5}],4:[function(require,module,exports){
(function (global){
var $           = (typeof window !== "undefined" ? window['$'] : typeof global !== "undefined" ? global['$'] : null);
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
   * @param {jQuery} $container The document container.
   * @param {jQuery} $mainNav   The main menu navigation container.
   */
  init: function($container, $mainNav) {
    var $button = $container.find('#button-main-nav');

    // Toggle a state class when the main menu navigation button is clicked.
    $button.on('click', function(event) {
      event.preventDefault();

      classToggle($container, 'is-showing-main-nav');
    });
  }

};

module.exports = Panels;

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{"./classToggle":1}],5:[function(require,module,exports){
(function (global){
var $ = (typeof window !== "undefined" ? window['$'] : typeof global !== "undefined" ? global['$'] : null);
var classToggle = require('./classToggle');


var Slideshow = function ($content) {

  var _this = this;

  this.$slideshow      = $('<div class="slideshow"></div>');
  this.$controllerPrev = $('<button class="__control button button--control -prev" data-direction="prev"><span class="icon icon-prev" data-icon="&#x3c"></span></button>');
  this.$controllerNext = $('<button class="__control button button--control -next" data-direction="next"><span class="icon icon-next" data-icon="&#x3e"></span></button>');
  this.$carousel       = $('<ul class="__carousel">' + $content.html() + '</ul>');
  this.$slides         = this.$carousel.find('[data-slideshow="content"]').closest('li');  // @TODO: maybe use something else instead of .card?
  this.slidesTotal     = this.$slides.length;
  this.activeIndex     = 0;

  this.$slides.addClass('__slide is-pending');
  this.$slideshow.append(this.$carousel);
  this.$slideshow.append(this.$controllerPrev, this.$controllerNext);

};


Slideshow.prototype.activate = function (selection) {

  if (selection) {
    this.activeIndex = (selection.closest('li').data('slide')) - 1; // account for zero-based index offset
  }

  this.show(this.activeIndex);
  this.controllerActivate();

};


Slideshow.prototype.controller = function (event) {

  var _this = event.data;
  var direction = $(this).data('direction');

  _this.move(direction);

}


Slideshow.prototype.controllerActivate = function () {

  // Update the controller button status.
  this.controllerUpdate();

  this.$slideshow.on('click', '.__control', this, this.controller);

}


Slideshow.prototype.controllerDeactivate = function () {

  this.$slideshow.off('click', '.__control');

}


Slideshow.prototype.controllerUpdate = function() {

  this.$controllerPrev.toggleClass('is-disabled', this.isFirstSlide());
  this.$controllerNext.toggleClass('is-disabled', this.isLastSlide());

}


Slideshow.prototype.isFirstSlide = function() {

  return (this.activeIndex === 0);

}


Slideshow.prototype.isLastSlide = function() {

  return (this.activeIndex === (this.slidesTotal - 1));

}


Slideshow.prototype.show = function (slideIndex) {

  var _$slides = this.$slides;

  if (slideIndex > 0) {
    for (i = 0; i < slideIndex; i++) {
      var $thisSlide = $(_$slides[i]);
      classToggle($thisSlide, 'is-pending');
      classToggle($thisSlide, 'is-completed');
    }
  }

  $selectedSlide = $(_$slides.get(slideIndex));
  classToggle($selectedSlide, 'is-pending');
  classToggle($selectedSlide, 'is-viewing');

}


Slideshow.prototype.move = function (direction) {

  var $currentSlide = $(this.$slides.get(this.activeIndex));

  if (direction === 'prev' && !this.isFirstSlide()) {
    $currentSlide.removeClass('is-viewing').addClass('is-pending');
    $currentSlide.prev().removeClass('is-completed').addClass('is-viewing');
    this.activeIndex--;
    this.controllerUpdate();
  } 
  else if (direction === 'next' && !this.isLastSlide()) {
    $currentSlide.removeClass('is-viewing').addClass('is-completed');
    $currentSlide.next().removeClass('is-pending').addClass('is-viewing');
    this.activeIndex++;
    this.controllerUpdate();
  }
  else {
    return false;
  }

}


Slideshow.prototype.reset = function () {

  this.$slides.each(function () {
    $slide = $(this);

    if ($slide.hasClass('is-completed') || $slide.hasClass('is-viewing')) {
      if ($slide.hasClass('is-completed')) {
        $slide.removeClass('is-completed');
      }

      if ($slide.hasClass('is-viewing')) {
        $slide.removeClass('is-viewing');
      }

      $slide.addClass('is-pending');
    }
  });

  this.controllerDeactivate();

}


module.exports = Slideshow;

}).call(this,typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{"./classToggle":1}]},{},[2])