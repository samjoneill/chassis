<?php
/**
 * Link
 * A standalone action link with an arrow icon.
 * For inline body-copy links, use a plain <a> element — global styles apply automatically.
 *
 * text  string  The visible link text.
 * href  string  Optional. The link URL. Default: #.
 *
 * ks_component( 'link', [
 *   'text' => 'Read the full report',
 *   'href' => get_permalink(),
 * ] );
 */
?>
<a href="<?php echo esc_url( $args['href'] ?? '#' ); ?>" class="u-link">
  <?php ks_component( 'icon', [ 'id' => 'arrow-right' ] ); ?>
  <span><?php echo esc_html( $args['text'] ?? '' ); ?></span></a>
