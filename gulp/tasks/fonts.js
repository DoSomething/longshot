/**
 * Task: fonts
 *
 * Place copy of files in fonts directory into dist directory.
 *
 */

var gulp   = require('gulp');
var config = require('../util/config');

gulp.task('fonts', function() {
  return gulp.src(config.fontsSrc + '/**')
    .pipe(gulp.dest(config.fontsDest))
});
