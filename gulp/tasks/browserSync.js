/**
 * Task: browserSync
 */

var gulp        = require('gulp');
var browserSync = require('browser-sync');
var config      = require('../util/config');

gulp.task('browserSync', ['build'], function() {
  browserSync.init([config.assetsDest + '/**'], {
    server: {
      baseDir: [config.assetsDest, 'assets']
    }
  });
});
