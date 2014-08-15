/**
 * Task: bundleLogger
 *
 * Provides gulp style logs to the bundle method in browserify.js
 */

var gulpUtil     = require('gulp-util');
var prettyHrtime = require('pretty-hrtime');
var startTime;

module.exports = {
  start: function() {
    startTime = process.hrtime();
    gulpUtil.log('Running', gulpUtil.colors.green("'bundle'") + '...');
  },

  end: function() {
    var taskTime = process.hrtime(startTime);
    var prettyTime = prettyHrtime(taskTime);
    gulpUtil.log('Finished', gulpUtil.colors.green("'bundle'"), 'in', gulpUtil.colors.magenta(prettyTime));
  }
};
