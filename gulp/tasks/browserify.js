/**
 * Task: browserify
 *
 * Bundle javascripty things with browserify!
 *
 * If the watch task is running, this uses watchify instead
 * of browserify for faster bundling using caching.
 */

var gulp         = require('gulp');
var browserify   = require('browserify');
var source       = require('vinyl-source-stream');
var uglify       = require('gulp-uglify');
var watchify     = require('watchify');
var bundleLogger = require('../util/bundleLogger');
var handleErrors = require('../util/handleErrors');

gulp.task('browserify', function() {

  var bundleMethod = global.isWatching ? watchify : browserify;

  var bundler = bundleMethod({
    // Specify the entry point for the app.
    entries: ['./app/assets/js/main.js'],
    // Enable source maps!
    debug: true
  });

  var bundle = function() {
    // Log when bundling starts.
    bundleLogger.start();

    return bundler
      .bundle()
      // Report compile errors.
      .on('error', handleErrors)
      // Use vinyl-source-stream to make the
      // stream gulp compatible. Specifiy the
      // desired output filename here.
      .pipe(source('main.js'))
      // Specify the output destination.
      .pipe(gulp.dest('./public/dist/js/'))
      // Log when bundling completes!
      .on('end', bundleLogger.end);
  };

  if (global.isWatching) {
    // Rebundle with watchify on changes.
    bundler.on('update', bundle);
  }

  return bundle();
});
