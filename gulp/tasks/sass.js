/**
 * Task: sass
 */

var gulp         = require('gulp');
var sass         = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var handleErrors = require('../util/handleErrors');
var config       = require('../util/config');

gulp.task('sass', function () {
  return gulp.src(config.sassSrc + '/**/*.scss')
    .pipe(sass({
      trace: true,
      bundleExec: true,
      require: 'susy',
      style: 'compressed',
      sourcemapPath: config.sassSrc,
      cacheLocation: config.sassSrc + '/.sass-cache',
    }))
    .on('error', handleErrors)
    .pipe(autoprefixer('last 5 version'))
    .pipe(gulp.dest(config.sassDest));
});
