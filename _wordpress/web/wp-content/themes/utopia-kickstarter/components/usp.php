<?php
/**
 * USP (Unique Selling Point)
 * A tick icon paired with a heading and description for highlighting key benefits.
 *
 * heading      string  The USP heading.
 * description  string  The supporting description text.
 *
 * ks_component( 'usp', [
 *   'heading'     => 'No hidden fees',
 *   'description' => 'Our pricing is fully transparent. What you see is what you pay.',
 * ] );
 */
?>
<div class="u-usp">
  <div class="u-usp__icon">
    <?php ks_component( 'icon', [ 'id' => 'tick' ] ); ?>
  </div>
  <div class="u-usp__content">
    <h3 class="u-usp__heading"><?php echo esc_html( $args['heading'] ?? '' ); ?></h3>
    <p class="u-usp__description"><?php echo esc_html( $args['description'] ?? '' ); ?></p>
  </div>
</div>
