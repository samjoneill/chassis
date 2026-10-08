<?php
/**
 * Ordered List
 * A numbered list with branded marker colour.
 *
 * items  array  Array of strings, one per list item.
 *
 * ks_component( 'ordered-list', [
 *   'items' => [
 *     'Submit the enquiry form.',
 *     'We will be in touch within two working days.',
 *     'An advisor will arrange a call with you.',
 *   ],
 * ] );
 */
?>
<ol class="u-ordered-list">
  <?php foreach ( $args['items'] ?? [] as $item ) : ?>
    <li class="u-ordered-list__item"><?php echo esc_html( $item ); ?></li>
  <?php endforeach; ?>
</ol>
