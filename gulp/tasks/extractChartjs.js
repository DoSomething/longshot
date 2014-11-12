/**
 * Task: extractChartjs
 *
 * Extract ChartJS from bower component and move into distribution.
 */

var gulp   = require('gulp');
var config = require('../util/config');

gulp.task('extractChartjs', function () {
  return gulp.src(config.bowerDir + '/chartjs/Chart.min.js')
    .pipe(gulp.dest(config.assetsDest + '/js'));
});
