/**
 * Task: watch
 * gulp/tasks/browserify.js handles js recompiling with watchify
 * gulp/tasks/browserSync.js automatically reloads any files that change within
 * the directory it's serving from (not using right now!).
 */

var gulp       = require('gulp');
var livereload = require('gulp-livereload');

gulp.task('watch', ['setWatch'], function() {
  gulp.watch('app/assets/sass/**', ['sass']);
  gulp.watch('app/assets/images/**', ['images']);
  gulp.watch('app/assets/js/main.js', ['browserify']);
  gulp.watch('public/dist/css/**').on('change', livereload.changed);
});
