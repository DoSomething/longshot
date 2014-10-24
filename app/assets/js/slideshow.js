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

  this.$slides.addClass('__slide -pending');
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

  if (direction === 'prev' && !$controlButton.hasClass('-disabled')) {
    _this.move(direction);
  } else if (direction === 'next' && !$controlButton.hasClass('-disabled')) {
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

  if (this.activeIndex === 0) {
    this.toggleButton(this.$controllerPrev, 'off');
    return;
  } 

  if (this.activeIndex === (this.slidesTotal - 1)) {
    this.toggleButton(this.$controllerNext, 'off');
    return;
  }

  if (this.activeIndex > 0) {
    if (this.$controllerPrev.hasClass('-disabled')) {
      this.toggleButton(this.$controllerPrev, 'on');
    }
  }

  if (this.activeIndex < (this.slidesTotal - 1)) {
    if (this.$controllerNext.hasClass('-disabled')) {
      this.toggleButton(this.$controllerNext, 'on');
    }
  }

}


Slideshow.prototype.toggleButton = function ($button, status) {

  if (status === 'off') {
    $button.addClass('-disabled');
    return;
  }

  if (status === 'on') {
    $button.removeClass('-disabled');
    return;
  }

}


Slideshow.prototype.show = function (slideIndex) {

  var _$slides = this.$slides;

  if (slideIndex > 0) {
    for (i = 0; i < slideIndex; i++) {
      var $thisSlide = $(_$slides[i]);
      classToggle($thisSlide, '-pending');
      classToggle($thisSlide, '-completed');
    }
  }
  
  $selectedSlide = $(_$slides.get(slideIndex));
  classToggle($selectedSlide, '-pending');
  classToggle($selectedSlide, '-viewing');

}


Slideshow.prototype.move = function (direction) {

  var $currentSlide = $(this.$slides.get(this.activeIndex));


  if (direction === 'prev') {
    $currentSlide.removeClass('-viewing').addClass('-pending');
    $currentSlide.prev().removeClass('-completed').addClass('-viewing');
    this.activeIndex--;
    this.controllerUpdate();
  }

  if (direction === 'next') {
    $currentSlide.removeClass('-viewing').addClass('-completed');
    $currentSlide.next().removeClass('-pending').addClass('-viewing');
    this.activeIndex++;
    this.controllerUpdate();
  }

}


Slideshow.prototype.reset = function () {

  var _$slides = this.$slides;

  _$slides.each(function () {
    $slide = $(this);
    
    if ($slide.hasClass('-completed') || $slide.hasClass('-viewing')) {
      if ($slide.hasClass('-completed')) {
        $slide.removeClass('-completed');
      }

      if ($slide.hasClass('-viewing')) {
        $slide.removeClass('-viewing');
      }

      $slide.addClass('-pending');
    }
  });

  this.toggleButton(this.$controllerPrev, 'on');
  this.toggleButton(this.$controllerNext, 'on');
  this.controllerDeactivate();

}


module.exports = Slideshow;
