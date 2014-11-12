/**
 * Task: build
 *
 * Build the project.
 *
 */

var gulp = require('gulp');

gulp.task('build', ['extract', 'compressLibs', 'sass', 'browserify', 'images', 'fonts']);
