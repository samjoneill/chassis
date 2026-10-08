<?php
/**
 * Component helpers — the PHP equivalent of
 * {% include 'components/_name' with { ... } only %}.
 */

/**
 * Render a component from components/{name}.php.
 *
 * @param string $name Component file name without extension, e.g. 'hero'.
 * @param array  $args Component parameters (see each component's docblock).
 */
function ks_component( string $name, array $args = [] ): void {
	get_template_part( 'components/' . $name, null, $args );
}

/**
 * Return a component's markup as a string.
 */
function ks_get_component( string $name, array $args = [] ): string {
	ob_start();
	ks_component( $name, $args );
	return (string) ob_get_clean();
}

/**
 * Build pagination component args from the main query.
 *
 * ks_component( 'pagination', ks_pagination_args() );
 *
 * @return array|null Null when there is only one page.
 */
function ks_pagination_args( ?WP_Query $query = null ): ?array {
	$query = $query ?? $GLOBALS['wp_query'];
	$pages = (int) $query->max_num_pages;

	if ( $pages < 2 ) {
		return null;
	}

	$current    = max( 1, (int) get_query_var( 'paged' ) );
	$page_hrefs = [];

	for ( $i = 1; $i <= $pages; $i++ ) {
		$page_hrefs[ $i ] = get_pagenum_link( $i );
	}

	return [
		'pages'        => $pages,
		'current_page' => $current,
		'prev_href'    => $current > 1 ? get_pagenum_link( $current - 1 ) : '#',
		'next_href'    => $current < $pages ? get_pagenum_link( $current + 1 ) : '#',
		'page_hrefs'   => $page_hrefs,
	];
}
