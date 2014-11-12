/**
 * Task: images
 */

var gulp     = require('gulp');
var changed  = require('gulp-changed');
var imagemin = require('gulp-imagemin');
var config   = require('../util/config');

gulp.task('images', function() {
  return gulp.src(config.imagesSrc + '/**')
    .pipe(changed(config.imagesDest)) // Ignore unchanged files
    // .pipe(imagemin()) // Optimize
    .pipe(gulp.dest(config.imagesDest));
});
