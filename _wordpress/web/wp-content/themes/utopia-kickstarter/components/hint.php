<?php
/**
 * Hint
 * A small helper text element displayed below a form label.
 *
 * text  string  The hint text.
 *
 * ks_component( 'hint', [
 *   'text' => 'Enter your number in international format.',
 * ] );
 */
?>
<p class="u-hint"><?php echo esc_html( $args['text'] ?? '' ); ?></p>
