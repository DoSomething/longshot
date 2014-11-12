/**
 * Task: extract
 *
 * Extract bower components and relocate them where specified.
 *
 */

var gulp = require('gulp');

gulp.task('extract', ['extractJquery', 'extractNormalize', 'extractBootstrap', 'extractChartjs']);
