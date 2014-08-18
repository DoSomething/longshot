/**
 * Task: handleErrors
 *
 * Provides gulp style logs to the bundle method in browserify.js
 * @todo : gulp-notify works for OSX, but not Linux on VM. Need to
 * test for funciton existence, and if not default to terminal
 * messages.
 */

var notify = require("gulp-notify");

module.exports = function() {

  var args = Array.prototype.slice.call(arguments);

  // Send error to notification center with gulp-notify.
  notify.onError({
    title: "Compile Error",
    message: "<%= error.message %>"
  }).apply(this, args);

  // Keep gulp from hanging on this task.
  this.emit('end');
};
