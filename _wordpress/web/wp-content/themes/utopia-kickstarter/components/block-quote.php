<?php
/**
 * Block Quote
 * An inline quotation with a branded left border.
 *
 * quote  string  The quoted text.
 *
 * ks_component( 'block-quote', [
 *   'quote' => 'Design is not just what it looks like. Design is how it works.',
 * ] );
 */
?>
<blockquote class="u-block-quote">
  <p><?php echo esc_html( $args['quote'] ?? '' ); ?></p>
</blockquote>
