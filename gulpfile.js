const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

// const vendorDepends = {
//     materialize: {
//         css: ['']
//     }
// };

function bundleVendorJs(){
    return gulp.src([
        './lib/materialize/js/materialize.min.js',
        './node_modules/j-prism-toolbar/dist/jPrismToolbar.min.js',
        './node_modules/wowjs/dist/wow.min.js',
        './node_modules/clipboard/dist/clipboard.min.js',
        './node_modules/masonry-layout/dist/masonry.pkgd.min.js',
        './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js'
    ])
        .pipe(concat('vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./lib/'));
}

function bundleVendorCss(){
    return gulp.src([
        // './node_modules/font-awesome/css/font-awesome.min.css',
        './node_modules/animate.css/animate.min.css',
        './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.css'
    ])
        .pipe(concat('vendor.min.css'))
        .pipe(gulp.dest('./lib'));
}
exports.default = gulp.parallel(bundleVendorCss,bundleVendorJs);