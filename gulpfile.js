const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Define paths
const paths = {
    scss: {
        src: 'src/scss/**/*.scss',
        dest: 'dist/css'
    }
};

// Compile SCSS to CSS
function styles() {
    return gulp.src(paths.scss.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(paths.scss.dest));
}

// Watch files
function watchFiles() {
    gulp.watch(paths.scss.src, styles);
}

// Define complex tasks
const build = gulp.series(styles);
const watch = gulp.parallel(watchFiles);

// Export tasks
exports.styles = styles;
exports.watch = watch;
exports.default = gulp.series(styles, watch);  // Set the default task to compile styles and watch for changes
