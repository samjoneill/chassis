<?php
/**
 * ACF integration: field groups in acf-json/, and the "Components" flexible
 * content field, whose layouts render through layouts/{name}.php.
 */

/**
 * Keep ACF field groups in version control.
 */
add_filter( 'acf/settings/save_json', fn() => get_theme_file_path( 'acf-json' ) );

add_filter( 'acf/settings/load_json', function ( array $paths ) {
	$paths[] = get_theme_file_path( 'acf-json' );
	return $paths;
} );

/**
 * Render each row of a flexible content field through layouts/{layout}.php.
 *
 * @param string $field   Flexible content field name.
 * @param mixed  $post_id Defaults to the current post.
 */
function ks_flexible_components( string $field = 'components', $post_id = false ): void {
	if ( ! function_exists( 'have_rows' ) ) {
		return; // ACF not active.
	}

	while ( have_rows( $field, $post_id ) ) {
		the_row();
		get_template_part( 'layouts/' . get_row_layout() );
	}
}

/**
 * Convert an ACF link field (array) to component action_text / action_href.
 *
 * @param mixed $link
 * @return array{0: string, 1: string}
 */
function ks_acf_link( $link ): array {
	if ( ! is_array( $link ) || empty( $link['url'] ) ) {
		return [ '', '' ];
	}
	return [ (string) ( $link['title'] ?: $link['url'] ), (string) $link['url'] ];
}
