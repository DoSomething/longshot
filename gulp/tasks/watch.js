/**
 * Task: watch
 * gulp/tasks/browserify.js handles js recompiling with watchify
 * gulp/tasks/browserSync.js automatically reloads any files that change within
 * the directory it's serving from (not using right now!).
 */

var gulp       = require('gulp');
var livereload = require('gulp-livereload');

gulp.task('watch', ['setWatch'], function() {
  gulp.watch('assets/sass/**', ['sass']);
  gulp.watch('assets/images/**', ['images']);
  gulp.watch('assets/js/main.js', ['browserify']);
  gulp.watch('assets/dist/css/**').on('change', livereload.changed);
});
