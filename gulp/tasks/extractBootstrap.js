/**
 * Task: extractBootstrap
 *
 * Extract jQuery from bower component and move into distribution.
 */

var gulp   = require('gulp');
var config = require('../util/config');

gulp.task('extractBootstrap', function () {
  gulp.src(config.bowerDir + '/bootstrap/dist/css/bootstrap.min.css')
    .pipe(gulp.dest(config.assetsDest + '/css'));

  gulp.src(config.bowerDir + '/bootstrap/dist/fonts/**')
    .pipe(gulp.dest(config.assetsDest + '/fonts'));

  gulp.src(config.bowerDir + '/bootstrap/dist/js/bootstrap.min.js')
    .pipe(gulp.dest(config.assetsDest + '/js'));

  return;
});
