
'use strict';

const config = require( './package.json' ).config;
const source_path = config.asset_source_path;
const destination_path = config.asset_destination_path;

const path = require( 'path' );
const autoprefixer = require( 'autoprefixer' );
const { src, dest, series, parallel, watch } = require( 'gulp' );
const cssLint = require( 'gulp-csslint' );
const imagemin = require( 'gulp-imagemin' );
const livereload = require( 'gulp-livereload' );
const postcss = require( 'gulp-postcss' );
const rename = require( 'gulp-rename' );
const sass = require('gulp-sass')(require('sass'));
const sassLint = require( 'gulp-sass-lint' );
const rollup = require( 'rollup' );
const { eslint } = require( 'rollup-plugin-eslint' );
const { uglify } = require( 'rollup-plugin-uglify' );
const buble = require( '@rollup/plugin-buble' );
const json = require( '@rollup/plugin-json' );
const resolve = require( '@rollup/plugin-node-resolve' );
const yaml = require( '@rollup/plugin-yaml' );

sass.compiler = require( 'sass' );

function task_sass_lint() {
	return src( `${source_path}/sass/{main,cookies/**/*,site/**/*}.scss` )
		.pipe( sassLint( {
			formatter: 'stylish',
		} ) )
		.pipe( sassLint.format() );
}

function task_sass_process() {
	return src( `${source_path}/sass/main.scss` )
		.pipe( sass( {
			importer: require( 'node-sass-yaml-importer' ),
			outputStyle: ( config.production ? 'compressed' : null ),
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( [
			autoprefixer(),
		] ) )
		.pipe( rename( 'final.css' ) )
		.pipe( dest( `${destination_path}/css` ) )
		.pipe( livereload() );
}

function task_css_lint() {
	return src( `${destination_path}/css/final.css` )
		.pipe( cssLint( {
			'adjoining-classes': false,
			'box-sizing': false,
			'box-model': false,
			'bulletproof-font-face': false,
			'compatible-vendor-prefixes': false,
			'font-sizes': false,
			'fallback-colors': false,
			'qualified-headings': false,
			'unique-headings': false,
			'order-alphabetical': false,
			'outline-none': false,
		} ) )
		.pipe( cssLint.formatter( require( 'csslint-stylish' ) ) );
}

function task_js_process() {
	const destination_file = `${destination_path}/js/final.js`;
	return rollup.rollup( {
		input: `${source_path}/js/main.js`,
		context: 'window',
		plugins: [
			json(),
			yaml( {
				include: `${source_path}/variables.yml`,
			} ),
			resolve( {
				browser: true,
				preferBuiltins: true
			} ),
			eslint( {
				include: [
					`${source_path}/js/*.js`,
				]
			} ),
			buble(),
			uglify(),
		]
	} ).then( bundle => {
		const result = bundle.write( {
			file: destination_file,
			format: 'iife',
			name: 'chassis',
			sourcemap: !config.production,
		} );
		return result;
	} ).then( result => {
		livereload.changed( path.resolve( destination_file ) );
		return result;
	} );
}

function task_js_copy_vendor_solo() {
	return src( `${source_path}/js/vendor-solo/*` )
		.pipe( dest( `${destination_path}/js` ) )
		.pipe( livereload() );
}

function task_images_process() {
	return src( `${source_path}/img/**/*` )
		.pipe( imagemin() )
		.pipe( dest( `${destination_path}/img` ) )
		.pipe( livereload() );
}

function task_fonts_copy() {
	return src( `${source_path}/fonts/**/*` )
		.pipe( dest( `${destination_path}/fonts` ) )
		.pipe( livereload() );
}

const task_css_all = parallel( task_sass_lint, series( task_sass_process, task_css_lint ) );
const task_js_all = parallel( task_js_process, task_js_copy_vendor_solo );
const task_images_all = task_images_process;
const task_fonts_all = task_fonts_copy;

function task_watch( cb ) {
	livereload.listen();
	watch( [`${source_path}/sass/**/*.scss`], task_css_all );
	watch( [`${source_path}/js/*.js`, `${source_path}/js/vendor/*.js`], task_js_process );
	watch( [`${source_path}/js/vendor-solo/*.js`], task_js_copy_vendor_solo );
	watch( [`${source_path}/img/**/*`], task_images_all );
	watch( [`${source_path}/fonts/**/*`], task_fonts_all );
	watch( [config.templates_dir] ).on( 'change', ( changed_path ) => {
		livereload.changed( path.resolve( changed_path ) );
	} );
	cb();
}

exports.js = task_js_all;
exports.css = task_css_all;
exports.images = task_images_all;
exports.fonts = task_fonts_all;
exports.watch = task_watch;

exports.default = exports.all = parallel(
	task_css_all,
	task_js_all,
	task_images_all,
	task_fonts_all
);
