<?php
/**
 * Prose
 * A block of rich text (paragraphs, headings, lists, links, quotes) with consistent vertical rhythm.
 *
 * content  string  The rich text. HTML is allowed and passed through wp_kses_post.
 * width    string  Optional. Maximum line length. One of: default, wide, full. Default: default.
 *
 * ks_component( 'prose', [
 *   'content' => '<h2>A heading</h2><p>Some <strong>rich</strong> text.</p>',
 *   'width'   => 'default',
 * ] );
 */

if ( empty( $args['content'] ) ) {
  return;
}
?>
<div class="prose" data-prose-width="<?php echo esc_attr( $args['width'] ?? 'default' ); ?>">
  <?php echo wp_kses_post( $args['content'] ); ?>
</div>
