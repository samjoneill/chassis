<?php
/**
 * Theme supports, menus and image sizes.
 */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ] );

	register_nav_menus( [
		'primary' => __( 'Primary', 'utopia-kickstarter' ),
		'footer'  => __( 'Footer', 'utopia-kickstarter' ),
	] );

	/*
	 * Image sizes mirror the Craft transforms used in the component docs.
	 * WordPress builds srcset from every size sharing the original's
	 * aspect ratio, so pass the smallest sensible size as `image_size`.
	 */
	add_image_size( 'card', 800, 0 );
	add_image_size( 'content', 1600, 0 );
	add_image_size( 'hero', 2000, 0 );
	add_image_size( 'avatar', 72, 72, true );
} );

/**
 * Output generated sizes as WebP (Craft transforms used format: 'webp').
 */
add_filter( 'image_editor_output_format', function ( $formats ) {
	$formats['image/jpeg'] = 'image/webp';
	$formats['image/png']  = 'image/webp';
	return $formats;
} );
