const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;

function bundleVendorJs(){
    return gulp.src([
        './node_modules/materialize-css/dist/js/materialize.min.js',
        './node_modules/j-prism-toolbar/dist/jPrismToolbar.min.js'
    ])
        .pipe(concat('vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./lib/'));
}

function bundleVendorCss(){
    return gulp.src([
        './node_modules/animate.css/animate.min.css'
    ])
        .pipe(concat('vendor.min.css'))
        .pipe(gulp.dest('./lib'));
}

exports.default = gulp.parallel(bundleVendorCss,bundleVendorJs);