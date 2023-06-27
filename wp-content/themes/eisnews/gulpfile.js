const { src, dest, watch, parallel, series } = require('gulp');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');

//const browserSync = require('browser-sync').create();
//sass.compiler = require('node-sass');

function style() {
    return src('./assets/scss/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write("."))
        .pipe(dest('./assets/'));
}

exports.style = style;