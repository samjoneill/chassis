<?php
/**
 * Icon
 * Renders a single icon from the SVG sprite.
 *
 * id       string  The icon ID corresponding to a symbol in sprite.svg.
 * classes  string  Optional. Additional CSS classes on the SVG element.
 * size     string  Optional. Size modifier appended as `icon--{size}` class.
 *
 * ks_component( 'icon', [
 *   'id' => 'arrow-right',
 * ] );
 */

$id    = $args['id'] ?? '';
$class = $args['classes'] ?? '';
if ( isset( $args['size'] ) ) {
  $class .= ' icon--' . $args['size'];
}
$sprite = get_theme_file_uri( 'assets/images/icons/sprite.svg' );
?>
<svg role="img" aria-hidden="true" focusable="false" class="icon icon--<?php echo esc_attr( $id ); ?> icon--m <?php echo esc_attr( trim( $class ) ); ?>">
  <use xlink:href="<?php echo esc_url( $sprite . '#' . $id ); ?>"></use>
</svg>
