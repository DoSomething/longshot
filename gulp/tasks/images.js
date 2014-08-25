/**
 * Task: images
 */

var gulp       = require('gulp');
var changed    = require('gulp-changed');
var imagemin   = require('gulp-imagemin');

gulp.task('images', function() {
  var dest = './public/dist/images';

  return gulp.src('./app/assets/images/**')
    .pipe(changed(dest)) // Ignore unchanged files
    // .pipe(imagemin()) // Optimize
    .pipe(gulp.dest(dest));
});
