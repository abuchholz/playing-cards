var elixir = require('laravel-elixir');
var gulp = require('gulp');
var gulpSequence = require('gulp-sequence');
var sourcemaps = require('gulp-sourcemaps');
var exists = require('path-exists').sync;
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var sass = require('gulp-sass');
var exec = require('child_process').exec;
var babel = require('gulp-babel');


gulp.task('move-css', function () {
    var filesToMove = [
        './bower_components/bootstrap/dist/css/bootstrap.css.map',
        './bower_components/bootstrap/dist/css/bootstrap.css',
        './node_modules/deck-of-cards/example/example.css'
    ];
    return gulp.src(filesToMove).pipe(gulp.dest('./public/assets/css/vendor'));
});

gulp.task('move-js', function () {
    gulp.src('./bower_components/requirejs/require.js').pipe(gulp.dest('./public/assets/js'));

    var filesToMove = [
        './bower_components/jquery/dist/jquery.js',
        './bower_components/jquery-md5/jquery.md5.js',
        './bower_components/jquery-ui/ui/jquery-ui.js',
        './bower_components/bootstrap/dist/js/bootstrap.js',
        './node_modules/deck-of-cards/dist/deck.js'
    ];
    return gulp.src(filesToMove).pipe(gulp.dest('./public/assets/js/vendor'));
});


gulp.task('minify', function () {

    gulp.src('public/assets/fonts/**/*').pipe(gulp.dest('public/dist/fonts'));
    gulp.src('public/assets/fonts/**/*').pipe(gulp.dest('public/build/dist/fonts'));
    gulp.src(['public/assets/css/vendor/*.css', 'public/assets/css/main.css'])
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(concat('main.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('public/dist/css'));

});

gulp.task('sass', function () {

    gulp.src('resources/assets/fonts/**/*').pipe(gulp.dest('public/assets/fonts'));
    return gulp.src('resources/assets/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('public/assets/css'));
});


gulp.task('copy-js', function () {
    return gulp.src('resources/assets/js/**/*').pipe(babel()).pipe(gulp.dest('public/assets/js'));
});

gulp.task('rjs', function () {
    exec('r.js -o build.js', function (err, stdout, stderr) {
        console.log(stderr);
        console.log(stdout);
    });

    return gulp.src('public/assets/js/require.js').pipe(gulp.dest('public/dist/js'));
});

gulp.task('compile-sass', function (callback) {
    gulpSequence('sass', 'minify')(callback)
});

gulp.task('compile-js', function (callback) {
    gulpSequence('copy-js', 'rjs')(callback)
});

gulp.task('compile-assets', gulpSequence('compile-sass', 'compile-js'));

elixir(function (mix) {
    mix.task('compile-sass', 'resources/assets/sass/**/*.scss');
    mix.task('compile-js', 'resources/assets/js/**/*.js');


    mix.version([
        'public/dist/css/main.css',
        'public/dist/js/main.js'
    ]);

});