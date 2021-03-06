//-------------------------
// variable setting
//-------------------------

var gulp        = require('gulp'),
	data        = require('gulp-data'),
	sequence    = require('run-sequence'),
	plumber     = require('gulp-plumber'),
	notify      = require('gulp-notify'),
	browserSync = require('browser-sync'),
	jade        = require('gulp-jade'),
	extender    = require('gulp-html-extend'),
	prettify    = require('gulp-prettify'),
	sass        = require('gulp-ruby-sass'),
	cmq         = require('gulp-combine-media-queries'),
	please      = require('gulp-pleeease'),
	uglify      = require('gulp-uglify'),
	sprite      = require('gulp.spritesmith'),
	imagemin    = require('gulp-imagemin'),
	pngquant    = require('imagemin-pngquant'),
	changed     = require('gulp-changed'),
	cache       = require('gulp-cached'),
	fs          = require('fs'),
	del         = require('del'),
	vinylPaths  = require('vinyl-paths'),
	filter      = require('gulp-filter');

var PLEASE_BROWSERS = [
		'last 2 versions',
		'ie >= 8'
	];

//-------------------------
// jade
//-------------------------

gulp.task('jade', function(){
	return gulp.src(['dev/jade/**/*.jade','!dev/jade/templates/**/*.jade'])
		// .pipe(changed('dev/extend/', {extension: ['.html','.json']}))
		.pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
		.pipe(jade({
			doctype: 'html', //on = not xhtml
			data: JSON.parse(fs.readFileSync('./dev/jade/config.json'))
		}))
		.pipe(prettify({
			indent_size: 1,
			// indent_char: ' ',
			eol : '\r\n',
			indent_with_tabs: true
		}))
		.pipe(gulp.dest('dist/'))
		.pipe(browserSync.reload({stream: true}));
});

//-------------------------
// scss
//-------------------------

gulp.task('scss',function(){
	return sass('dev/scss',{style : 'expanded'})
		.pipe(cache('scss'))
		.pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
		.pipe(cmq({log: true}))
		.pipe(please({
			"minifier": false,
			'autoprefixer': {
				browesers: [PLEASE_BROWSERS]
			}
		}))
		.pipe(gulp.dest('dist/assets/css/'))
		.pipe(browserSync.reload({stream: true}));
});

//-------------------------
// compile js
//-------------------------

// gulp.task('uglify', function(){
// 	return gulp.src(['dev/scripts/**/*.js'])
// 		.pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
// 		// .pipe(uglify({
// 		// 	preserveComments: 'some'
// 		// }))
// 		.pipe(gulp.dest('dist/scripts/'))
// 		.pipe(browserSync.reload({stream: true}));
// });

//-------------------------
// sprite generate
//-------------------------

gulp.task('sprite', function(){
	var spriteData = gulp.src(['dev/sprite/*.png'])
		.pipe(sprite({
			imgName: 'sprite.png',
			imgPath: '/assets/img/sprite.png',
			cssName: '_sprite.scss',
			padding: 5
		}));
	spriteData.img
		.pipe(imagemin({
			use:[pngquant({
				quality: 60-80,
				speed: 1
			})]
		}))
		.pipe(gulp.dest('dist/assets/img/'));
	spriteData.css
		.pipe(gulp.dest('dev/scss/'));
	return spriteData;
});

//-------------------------
// compression image
//-------------------------

gulp.task('imagemin', function(){
	var srcGlob = ['dev/images/**/*.+(jpg|jpeg|png|gif|svg)'];
	var distGlob = 'dist/assets/img/';
	return gulp.src(srcGlob)
		.pipe(changed(distGlob))
		.pipe(imagemin({
			progressive: true,
			interlaced: true,
			multipass: true,
			optimizationLevel: 4
			// use: [pngquant({
			// 	quality: 70-80,
			// 	speed: 1
			// })]
		}))
		.pipe(gulp.dest(distGlob));
});

//-------------------------
// server
//-------------------------

gulp.task('browser-sync', function(){
	browserSync({
		port: 3000,
		server: {
			baseDir: 'dist/'
		}
	});
});


//-------------------------
// build
//-------------------------

gulp.task('build', function(callback){
	return sequence(
		'sprite',
		'jade',
		['scss'],
		'imagemin',
		callback
	);
});

//-------------------------
// watch
//-------------------------

gulp.task('watch', ['build'], function(){
	gulp.watch(['dev/sprite/**'], ['sprite']);
	gulp.watch(['dev/images/**'], ['imagemin']);
	gulp.watch(['dev/scss/**'], ['scss']);
	gulp.watch(['dev/jade/**'], ['jade']);
	// gulp.watch(['dev/extend/**'], ['extend']);
	gulp.watch(['dev/scripts/**'], ['uglify']);
});

//-------------------------
// default
//-------------------------

gulp.task('default', ['browser-sync', 'watch']);
