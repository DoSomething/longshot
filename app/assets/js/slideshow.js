var $ = require('jquery');
var classToggle = require('./classToggle');


var Slideshow = function ($content) {
  console.log('[#1 Slideshow] Create Slideshow from constructor function.');

  var _this = this;

  this.$slideshow      = $('<div class="slideshow"></div>');
  this.$controller     = $('<ul class="__controller"><li class="__control -prev" data-direction="prev"><span class="icon icon-previous" data-icon="&#x25c0"></span></li><li class="__control -next" data-direction="next"><span class="icon icon-next" data-icon="&#x25ba"></span></li></ul>');
  this.$controllerPrev = this.$controller.find('.-prev');
  this.$controllerNext = this.$controller.find('.-next');
  this.$carousel       = $('<ul class="__carousel">' + $content.html() + '</ul>');
  this.$slides         = this.$carousel.find('.card').parent();  // @TODO: maybe use something else instead of .card?
  this.slidesTotal     = this.$slides.length;
  this.activeIndex     = 0;

  this.$slides.addClass('__slide -pending');
  this.$slideshow.append(this.$carousel);
  this.$slideshow.append(this.$controller);

  console.log(this);

};


Slideshow.prototype.activate = function (selection) {
  console.log('[#2 Slideshow] Activating Slideshow.');
  
  if (selection) {
    this.activeIndex = (selection.parent().data('slide')) - 1; // account for zero-based index offset
  }

  this.show(this.activeIndex);
  this.controllerActivate();
  
};


Slideshow.prototype.controller = function (event) {
  console.log('[#5 Slideshow] Activate Slideshow controller.');

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
  console.log('[#4 Slideshow] Activate Slideshow controller.');

  // Update the controller button status.
  this.controllerUpdate();

  this.$controller.on('click', '.__control', this, this.controller);

}


Slideshow.prototype.controllerDeactivate = function () {
  console.log('[#6 Slideshow] Deactivate Slideshow controller.');

  this.$controller.off('click', '.__control');

}


Slideshow.prototype.controllerUpdate = function() {
  console.log('[#n Slideshow] Updating Controller buttons.');
  console.log('Updating and index is now ' + this.activeIndex);

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
  console.log('[#n Slideshow] Toggle Controller button.');

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
  console.log('[#3 Slideshow] Showing Slideshow slide.');

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
  console.log('[#5 Slideshow] Moving to ' + direction + ' Slide.');

  var $currentSlide = $(this.$slides.get(this.activeIndex));


  if (direction === 'prev') {
    console.log($currentSlide);
    $currentSlide.removeClass('-viewing').addClass('-pending');
    $currentSlide.prev().removeClass('-completed').addClass('-viewing');  // Don't like this too much, might be better to use index!
    this.activeIndex--;
    this.controllerUpdate();
  }

  if (direction === 'next') {
    console.log($currentSlide);
    $currentSlide.removeClass('-viewing').addClass('-completed');
    $currentSlide.next().removeClass('-pending').addClass('-viewing');  // Don't like this too much, might be better to use index!
    this.activeIndex++;
    this.controllerUpdate();
  }

}


Slideshow.prototype.reset = function () {
  console.log('[#6 Slideshow] Resetting Slideshow.');

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
