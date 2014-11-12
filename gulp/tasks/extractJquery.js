/**
 * Task: extractJquery
 *
 * Extract jQuery from bower component and move into distribution.
 */

var gulp   = require('gulp');
var config = require('../util/config');

gulp.task('extractJquery', function () {
  return gulp.src(config.bowerDir + '/jquery/dist/jquery.min.js')
    .pipe(gulp.dest(config.assetsDest + '/js'));
});
