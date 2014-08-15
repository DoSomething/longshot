/**
 * Task: browserSync
 */

var gulp        = require('gulp');
var browserSync = require('browser-sync');

gulp.task('browserSync', ['build'], function() {
  browserSync.init(['assets/dist/**'], {
    server: {
      baseDir: ['assets/dist', 'assets']
    }
  });
});
