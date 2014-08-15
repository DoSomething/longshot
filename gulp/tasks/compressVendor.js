/**
 * Task: compressVendor
 *
 * Run a variety of tasks on standalone vendor JS files.
 *
 */

var gulp   = require('gulp');
var uglify = require('gulp-uglify');

gulp.task('compressVendor', function() {
  return gulp.src('./app/assets/js/vendor/**')
    .pipe(uglify())
    .pipe(gulp.dest('public/dist/js'))
});
