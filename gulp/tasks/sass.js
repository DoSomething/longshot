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
      compass: true,
      sourcemap: true,
      sourcemapPath: '../sass'
    }))
    .on('error', handleErrors)
    .pipe(autoprefixer('last 5 version'))
    .pipe(gulp.dest('public/dist/css'));
});
