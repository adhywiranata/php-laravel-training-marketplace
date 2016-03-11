var elixir = require('laravel-elixir');

// include gulp
var gulp = require('gulp');

// include plug-ins

var jshint = require('gulp-jshint');

var sass = require('gulp-sass');

// JS hint task
gulp.task('jshint', function() {
  gulp.src('./src/scripts/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// sass
gulp.task('stylers', function() {
    gulp.src('resources/assets/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/css/'))
});

//DEFAULTS
gulp.task('sass-compile',function() {
    gulp.watch('resources/assets/sass/*.scss',['stylers']);
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');
    mix.sass('style.scss');
    mix.styles([
      '../bower/fg-formgenerator/dist/fg-formgenerator.min.css',
    ], 'public/css/vendor.css');
    mix.scripts([
    	'../bower/jquery/dist/jquery.js',
    	'../bower/modernizr-min/dist/modernizr-min.js',
    	'../bower/bootstrap/dist/js/bootstrap.js',
    	'../bower/chart-js/Chart.min.js',
    	'../bower/chart-js/Chart.min.js',
    	//'../bower/fg-formgenerator/dist/fg-formgenerator.min.js',
    	'../bower/fg-formgenerator/dev/fg-actions.js',
    	'../bower/fg-formgenerator/dev/fg-generators.js',
    	'../bower/fg-formgenerator/dev/fg-helpers.js',
    	'../bower/fg-formgenerator/dev/fg-validations.js',
    	'../js/underscore.min.js'
    ], 'public/js/vendor.js');
    mix.phpUnit();
});
