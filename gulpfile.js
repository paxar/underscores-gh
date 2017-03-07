/*  Gulp config for Word Press    ver:  0.1 beta   */

var gulp       = require('gulp'), // Подключаем Gulp
    sass         = require('gulp-sass'), //Подключаем Sass пакет,
    //browserSync  = require('browser-sync'), // Подключаем Browser Sync
    concat       = require('gulp-concat'), // Подключаем gulp-concat (для конкатенации файлов)
    //uglify       = require('gulp-uglifyjs'), // Подключаем gulp-uglifyjs (для сжатия JS)
    cssnano      = require('gulp-cssnano'), // Подключаем пакет для минификации CSS
    rename       = require('gulp-rename'), // Подключаем библиотеку для переименования файлов
    del          = require('del'), // Подключаем библиотеку для удаления файлов и папок
    //imagemin     = require('gulp-imagemin'), // Подключаем библиотеку для работы с изображениями
    //pngquant     = require('imagemin-pngquant'), // Подключаем библиотеку для работы с png
    cache        = require('gulp-cache'), // Подключаем библиотеку кеширования
    autoprefixer = require('gulp-autoprefixer');// Подключаем библиотеку для автоматического добавления префиксов
plumber = require('gulp-plumber');  //не тормозим при ошибках
sourcemaps = require('gulp-sourcemaps');  //исходные пути SCSS
notify = require("gulp-notify");

plumberErrorHandler = {
    errorHandler: notify.onError({
        title: 'Gulp',
        message: 'Error: <%= error.message %>'
    })
};

gulp.task('sass', function(){ // Создаем таск Sass
    return gulp.src('sass/**/*.scss') // Берем источник
        .pipe(plumber(plumberErrorHandler))
        .pipe(sourcemaps.init()) // подключаем sourcemaps
        .pipe(sass().on ('error', sass.logError)) // Преобразуем Sass в CSS посредством gulp-sass
        .pipe(autoprefixer(['last 3 versions'], { cascade: true })) // Создаем префиксы
        .pipe(sourcemaps.write('.')) // записываем sourcemaps
        .pipe(gulp.dest('.')) // Выгружаем результаты в папку
});




gulp.task('watch', [/*'browser-sync',*/ 'sass' /*, 'scripts'*/], function() {
    gulp.watch('sass/**/*.scss', ['sass']); // Наблюдение за sass файлами в папке sass

});


gulp.task('clear', function () {
    return cache.clearAll();
});

gulp.task('default', ['watch']);
