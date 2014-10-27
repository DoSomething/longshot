var $ = require('jquery');
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
  var $controlButton = $(this);
  var direction = $controlButton.data('direction');

  if (direction === 'prev' && !$controlButton.hasClass('is-disabled')) {
    _this.move(direction);
  } else if (direction === 'next' && !$controlButton.hasClass('is-disabled')) {
    _this.move(direction);
  } else {
    return false;
  }

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

  // If first slide selected, turn off the Prev controller button.
  if (this.activeIndex === 0) {
    this.toggleButton(this.$controllerPrev, 'off');
    return;
  }

  // If last slide selected, turn off the Next controller button.
  if (this.activeIndex === (this.slidesTotal - 1)) {
    this.toggleButton(this.$controllerNext, 'off');
    return;
  }

  // If on any slide past first slide and Prev controller button is off, turn it on.
  if (this.activeIndex > 0) {
    if (this.$controllerPrev.hasClass('is-disabled')) {
      this.toggleButton(this.$controllerPrev, 'on');
    }
  }

  // If on any slide prior to last slide and Next controller button is off, turn it on.
  if (this.activeIndex < (this.slidesTotal - 1)) {
    if (this.$controllerNext.hasClass('is-disabled')) {
      this.toggleButton(this.$controllerNext, 'on');
    }
  }

}


Slideshow.prototype.toggleButton = function ($button, status) {

  if (status === 'off') {
    $button.addClass('is-disabled');
    return;
  }

  if (status === 'on') {
    $button.removeClass('is-disabled');
    return;
  }

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


  if (direction === 'prev') {
    $currentSlide.removeClass('is-viewing').addClass('is-pending');
    $currentSlide.prev().removeClass('is-completed').addClass('is-viewing');
    this.activeIndex--;
    this.controllerUpdate();
  }

  if (direction === 'next') {
    $currentSlide.removeClass('is-viewing').addClass('is-completed');
    $currentSlide.next().removeClass('is-pending').addClass('is-viewing');
    this.activeIndex++;
    this.controllerUpdate();
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

  this.toggleButton(this.$controllerPrev, 'on');
  this.toggleButton(this.$controllerNext, 'on');
  this.controllerDeactivate();

}


module.exports = Slideshow;
