/**
 * Task: extractNormalize
 *
 * Extract normalize from bower component and move into sass directory.
 */

var gulp   = require('gulp');
var rename = require('gulp-rename');
var config = require('../util/config');

gulp.task('extractNormalize', function () {
  return gulp.src(config.bowerDir + '/normalize.css/normalize.css')
    .pipe(rename('_normalize.scss'))
    .pipe(gulp.dest(config.sassSrc + '/_base'));
});
