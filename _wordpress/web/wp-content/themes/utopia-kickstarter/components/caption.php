<?php
/**
 * Caption
 * A small, muted text element for captions and supporting labels.
 *
 * text  string  The caption text.
 *
 * ks_component( 'caption', [
 *   'text' => 'Figure 1: Quarterly revenue by region.',
 * ] );
 */
?>
<p class="u-caption"><?php echo esc_html( $args['text'] ?? '' ); ?></p>
