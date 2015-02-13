var gulp = require('gulp'),
    browserify = require('browserify'),
    source = require('vinyl-source-stream'),
    hbsfy = require('hbsfy'),
    gutil = require('gulp-util'),
    fs = require('fs');

var configFile = fs.readFileSync('./gulp-config.json');
gulp.task('build', function() {
    config = JSON.parse(configFile);
    console.log(config.app);
    var b = browserify("./applications/" + config.app + ".js");
    b.transform(hbsfy);
    return b.bundle()
        .pipe(source(config.app + '.js'))
        .pipe(gulp.dest(config.destination)).on('error', gutil.log);
});

gulp.task('watch', function() {
    gulp.watch('./**/**/*.*', {interval: 500}, ['build']);
});

