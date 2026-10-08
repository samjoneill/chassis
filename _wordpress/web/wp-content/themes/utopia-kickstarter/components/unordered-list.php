<?php
/**
 * Unordered List
 * A bulleted list with branded marker colour.
 *
 * items  array  Array of strings, one per list item.
 *
 * ks_component( 'unordered-list', [
 *   'items' => [
 *     'Free initial consultation',
 *     'Dedicated account manager',
 *     'Monthly progress reports',
 *   ],
 * ] );
 */
?>
<ul class="u-unordered-list">
  <?php foreach ( $args['items'] ?? [] as $item ) : ?>
    <li class="u-unordered-list__item"><?php echo esc_html( $item ); ?></li>
  <?php endforeach; ?>
</ul>
