/**
 * Task: compass
 */

var compass      = require('gulp-compass');
var gulp         = require('gulp');
var handleErrors = require('../util/handleErrors');

gulp.task('compass', function() {
  return gulp.src('./app/assets/sass/**/*.scss')
    .pipe(compass({
      config_file: './config.rb',
      css: 'public/dist/css',
      sass: 'app/assets/sass'
    }))
    .on('error', handleErrors);
});
