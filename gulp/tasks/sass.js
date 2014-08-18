/**
 * Task: sass
 */

var gulp         = require('gulp');
var sass         = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var handleErrors = require('../util/handleErrors');

gulp.task('sass', function () {
  return gulp.src('./app/assets/sass/**/*.scss')
    .pipe(sass({
      bundleExec: true,
      require: 'susy',
      style: 'compressed',
      sourcemap: true,
      sourcemapPath: '../../app/assets/sass',
      cacheLocation: './app/assets/.sass-cache',
    }))
    .on('error', handleErrors)
    .pipe(autoprefixer('last 5 version'))
    .pipe(gulp.dest('./public/dist/css'));
});
