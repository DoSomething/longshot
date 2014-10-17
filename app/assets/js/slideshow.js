var $ = require('jquery');

function Slideshow($content) {
  this.$content = $content;
  this.$slideshow = $('<ul class="slideshow">' + this.$content.html() + '</ul>');
  this.$slides = this.$slideshow.find('.card').parent();
  this.$slides.addClass('__slide -pending');

  // console.log(this.$slides);
  return this.$slideshow;
}

Slideshow.prototype.controller = '<ul class="slideshow-controller"><li class="__control -prev -disabled" data-direction="prev"><span class="icon icon-previous" data-icon="&#x25c0"></span></li><li class="__control -next" data-direction="next"><span class="icon icon-next" data-icon="&#x25ba"></span></li></ul>';

Slideshow.prototype.activate = function activate() {
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
