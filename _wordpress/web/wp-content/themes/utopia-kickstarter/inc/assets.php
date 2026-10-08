<?php
/**
 * Front-end assets built by gulp into assets/.
 */

/**
 * Cache-busting version for a built asset.
 */
function ks_asset_version( string $path ): ?string {
	$file = get_theme_file_path( $path );
	return file_exists( $file ) ? (string) filemtime( $file ) : null;
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'utopia-kickstarter',
		get_theme_file_uri( 'assets/css/main.css' ),
		[],
		ks_asset_version( 'assets/css/main.css' )
	);

	wp_enqueue_script(
		'utopia-kickstarter',
		get_theme_file_uri( 'assets/js/bundle.js' ),
		[],
		ks_asset_version( 'assets/js/bundle.js' ),
		[
			'strategy'  => 'defer',
			'in_footer' => true,
		]
	);
} );

/**
 * Flag JS support on <html> as early as possible.
 */
add_action( 'wp_head', function () {
	wp_print_inline_script_tag( "if (document.documentElement) { document.documentElement.className = 'has-js'; }" );
}, 1 );
