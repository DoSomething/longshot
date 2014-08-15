/**
 * Task: build
 *
 * Build the project.
 *
 */

var gulp = require('gulp');

gulp.task('build', ['browserify', 'compass', 'images', 'fonts', 'compressVendor']);
