/**
 * Task: watch
 * gulp/tasks/browserify.js handles js recompiling with watchify
 */

var gulp       = require('gulp');
var livereload = require('gulp-livereload');

gulp.task('watch', ['setWatch'], function() {
  gulp.watch('app/assets/sass/**', ['sass']);
  gulp.watch('app/assets/images/**', ['images']);
  gulp.watch('app/assets/js/**', ['browserify']);
  gulp.watch('public/dist/css/**').on('change', livereload.changed);
});
