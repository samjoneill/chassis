<?php
/**
 * Accordion
 * Expandable disclosure sections using the native <details> element.
 * No JavaScript required.
 *
 * items  array  Array of arrays, each with `title` (string) and `content` (string, HTML allowed).
 *
 * ks_component( 'accordion', [
 *   'items' => [
 *     [ 'title' => 'First section', 'content' => 'Content for the first section.' ],
 *     [ 'title' => 'Second section', 'content' => 'Content for the second section.' ],
 *   ],
 * ] );
 */

$items = $args['items'] ?? [];
?>
<div class="u-accordion">
  <?php foreach ( $items as $item ) : ?>
  <details class="u-accordion__item">
    <summary class="u-accordion__header">
      <?php echo esc_html( $item['title'] ?? '' ); ?>
      <?php ks_component( 'icon', [ 'id' => 'chevron-down' ] ); ?>
    </summary>
    <div class="u-accordion__content"><?php echo wp_kses_post( $item['content'] ?? '' ); ?></div>
  </details>
  <?php endforeach; ?>
</div>
