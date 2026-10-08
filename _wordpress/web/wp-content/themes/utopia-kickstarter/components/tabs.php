<?php
/**
 * Tabs
 * An accessible tabbed interface with keyboard navigation.
 * Requires the tabs IIFE in src/js/main.js to be loaded on the page.
 *
 * tabs     array   Array of arrays with `label` (string) and `content` (string, HTML allowed).
 * variant  string  Optional. Visual style. One of: 1 (underline), 2 (top border), 3 (filled). Default: 1.
 * label    string  Optional. Accessible aria-label for the tab list. Default: 'Content'.
 * id       string  Optional. Unique prefix for tab/panel IDs. Generated when omitted.
 *
 * ks_component( 'tabs', [
 *   'tabs'    => [
 *     [ 'label' => 'Overview', 'content' => 'Overview content here.' ],
 *     [ 'label' => 'Details', 'content' => 'Details content here.' ],
 *     [ 'label' => 'FAQs', 'content' => 'FAQ content here.' ],
 *   ],
 *   'variant' => '1',
 *   'label'   => 'Product information',
 * ] );
 */

$tabs    = array_values( $args['tabs'] ?? [] );
$tabs_id = $args['id'] ?? wp_unique_id( 'tabs-' );
?>
<div class="u-tabs" data-tabs-variant="<?php echo esc_attr( $args['variant'] ?? '1' ); ?>">
  <div class="u-tabs__list" role="tablist" aria-label="<?php echo esc_attr( $args['label'] ?? 'Content' ); ?>">
    <?php foreach ( $tabs as $i => $tab ) : ?>
      <button
        type="button"
        class="u-tabs__tab"
        id="<?php echo esc_attr( "{$tabs_id}-tab-{$i}" ); ?>"
        role="tab"
        aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
        aria-controls="<?php echo esc_attr( "{$tabs_id}-panel-{$i}" ); ?>"
        tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>"><?php echo esc_html( $tab['label'] ?? '' ); ?></button>
    <?php endforeach; ?>
  </div>
  <div class="u-tabs__panels">
    <?php foreach ( $tabs as $i => $tab ) : ?>
      <div
        class="u-tabs__panel"
        id="<?php echo esc_attr( "{$tabs_id}-panel-{$i}" ); ?>"
        role="tabpanel"
        aria-labelledby="<?php echo esc_attr( "{$tabs_id}-tab-{$i}" ); ?>"
        tabindex="0"
        <?php if ( 0 !== $i ) : ?>hidden<?php endif; ?>><?php echo wp_kses_post( $tab['content'] ?? '' ); ?></div>
    <?php endforeach; ?>
  </div>
</div>
