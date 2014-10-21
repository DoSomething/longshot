var $ = require('jquery');

var Slideshow = function ($content) {
  var _this = this;

  this.$slideshow  = $('<div class="slideshow"></div>');
  this.$controller = controller = '<ul class="__controller"><li class="__control -prev -disabled" data-direction="prev"><span class="icon icon-previous" data-icon="&#x25c0"></span></li><li class="__control -next" data-direction="next"><span class="icon icon-next" data-icon="&#x25ba"></span></li></ul>';
  this.$carousel   = $('<ul class="__carousel">' + $content.html() + '</ul>');
  this.$slides     = this.$carousel.find('.card').parent();  // @TODO: maybe use something else instead of .card?

  this.$slides.addClass('__slide -pending');
  this.$slideshow.append(this.$carousel);
  this.$slideshow.append(this.$controller);
};


Slideshow.prototype.activate = function () {
  console.log('working!');
};


module.exports = Slideshow;




// /**
//  * Slideshow creates an interactive slideshow.
//  *
//  * @type {Object}
//  */
// var Slideshow = {

//   $slideshow: null,
//   $slides: null,
//   $controller: null,
//   $activeIndex: 1,

//   /**
//    * Initialize the Slideshow
//    *
//    * @param {jQuery} [varname] [description]
//    */
//   init: function($modal, $content) {
//     this.$slideshow = $('<ul class="slideshow">' + $content.html() + '</ul>');
//     this.$slides = this.$slideshow.find('.card').parent();
//     this.$slides.addClass('__slide -pending');

//     return this.$slideshow;
//   },

//   activate: function($item) {
//     this.activeIndex = $item.parent().data('slide');
//     this.activeIndex = this.activeIndex - 1; // index offset
//     // console.log(this.activeIndex);

//     console.log($slides);
//   }

// };

// module.exports = Slideshow;



// var controllerOutput = '';
// controllerOutput += '<ul class="slideshow-controller">';
// controllerOutput += '<li class="__control -prev -disabled" data-direction="prev"><span class="icon icon-previous" data-icon="&#x25c0"></span></li>';
// controllerOutput += '<li class="__control -next" data-direction="next"><span class="icon icon-next" data-icon="&#x25ba"></span></li>';
// controllerOutput += '</ul>';

// $controller = $(controllerOutput);

// $modal.find('.wrapper').append($slideshow, $controller, this.$closeButton);

// // Append modal to the container.
// $container.append($modal);
