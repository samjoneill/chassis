<?php
/**
 * Pagination
 * A navigation component for paging through a list of results.
 *
 * pages         int     Total number of pages.
 * current_page  int     The currently active page number (1-based).
 * prev_href     string  Optional. URL for the previous page link. Default: #.
 * next_href     string  Optional. URL for the next page link. Default: #.
 * page_hrefs    array   Optional. Array keyed by page number mapping to page URLs.
 *
 * For the main query, ks_pagination_args() builds all of these:
 *
 * ks_component( 'pagination', ks_pagination_args() );
 */

$pages        = (int) ( $args['pages'] ?? 1 );
$current_page = (int) ( $args['current_page'] ?? 1 );
$page_hrefs   = $args['page_hrefs'] ?? [];
?>
<nav class="u-pagination" aria-label="Pagination">
  <ol class="u-pagination__list">
    <li>
      <a href="<?php echo esc_url( $args['prev_href'] ?? '#' ); ?>" class="u-pagination__prev">
        <?php ks_component( 'icon', [ 'id' => 'arrow-left' ] ); ?>
        <span>Previous</span>
      </a>
    </li>
    <?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
      <li>
        <a
          href="<?php echo esc_url( $page_hrefs[ $i ] ?? '#' ); ?>"
          class="u-pagination__link"
          <?php if ( $i === $current_page ) : ?>aria-current="page"<?php endif; ?>><?php echo (int) $i; ?></a>
      </li>
    <?php endfor; ?>
    <li>
      <a href="<?php echo esc_url( $args['next_href'] ?? '#' ); ?>" class="u-pagination__next">
        <span>Next</span>
        <?php ks_component( 'icon', [ 'id' => 'arrow-right' ] ); ?>
      </a>
    </li>
  </ol>
</nav>
