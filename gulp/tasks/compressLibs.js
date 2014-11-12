/**
 * Task: compressLibs
 *
 * Run a variety of tasks on standalone vendor JS files.
 *
 */

var gulp   = require('gulp');
var uglify = require('gulp-uglify');
var config = require('../util/config');

gulp.task('compressLibs', function() {
  return gulp.src(config.jsSrc + '/libs/**')
    .pipe(uglify())
    .pipe(gulp.dest(config.jsDest))
});
