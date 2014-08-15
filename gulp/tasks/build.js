/**
 * Task: build
 *
 * Build the project.
 *
 */

var gulp = require('gulp');

gulp.task('build', ['browserify', 'sass', 'images', 'fonts', 'compressVendor']);
