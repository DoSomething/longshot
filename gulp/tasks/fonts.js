/**
 * Task: fonts
 *
 * Place copy of files in fonts directory into dist directory.
 *
 */

var gulp = require('gulp');

gulp.task('fonts', function() {
  return gulp.src('./app/assets/fonts/**')
    .pipe(gulp.dest('public/dist/fonts'))
});
