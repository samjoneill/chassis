<?php
/**
 * Button
 * A styled button element with an arrow icon. Pass `href` to render as a link instead.
 *
 * label    string   The button label.
 * variant  string   Optional. Visual style. One of: primary, outline. Default: primary.
 * size     string   Optional. Button size. One of: large, small. Default: large.
 * ghost    boolean  Optional. Renders a transparent ghost variant. Default: false.
 * href     string   Optional. When set, renders an <a> element instead of <button>.
 * type     string   Optional. HTML button type (ignored when href is set). One of: button, submit, reset. Default: button.
 *
 * ks_component( 'button', [
 *   'label'   => 'Get in touch',
 *   'variant' => 'primary',
 *   'type'    => 'submit',
 * ] );
 *
 * ks_component( 'button', [
 *   'label' => 'Learn more',
 *   'href'  => get_permalink(),
 * ] );
 */

$variant = $args['variant'] ?? 'primary';
$size    = $args['size'] ?? 'large';
$ghost   = ! empty( $args['ghost'] );
$href    = $args['href'] ?? '';
?>
<?php if ( $href ) : ?>
  <a href="<?php echo esc_url( $href ); ?>"
    class="u-button"
    data-button-variant="<?php echo esc_attr( $variant ); ?>"
    data-button-size="<?php echo esc_attr( $size ); ?>"
    <?php if ( $ghost ) : ?>data-ghost-button<?php endif; ?>>
    <?php echo esc_html( $args['label'] ?? '' ); ?>
    <?php ks_component( 'icon', [ 'id' => 'button-arrow' ] ); ?>
  </a>
<?php else : ?>
  <button
    type="<?php echo esc_attr( $args['type'] ?? 'button' ); ?>"
    class="u-button"
    data-button-variant="<?php echo esc_attr( $variant ); ?>"
    data-button-size="<?php echo esc_attr( $size ); ?>"
    <?php if ( $ghost ) : ?>data-ghost-button<?php endif; ?>>
    <?php echo esc_html( $args['label'] ?? '' ); ?>
    <?php ks_component( 'icon', [ 'id' => 'button-arrow' ] ); ?>
  </button>
<?php endif; ?>
