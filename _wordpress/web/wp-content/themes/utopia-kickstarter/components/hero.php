<?php
/**
 * Hero
 * A full-width banner with an optional background image, heading, lead text, and action link.
 *
 * heading      string  The main heading text.
 * lead         string  Optional. Supporting lead paragraph.
 * image        int     Optional. Attachment ID for the background image.
 * image_size   string  Optional. Registered image size used for src. Default: hero.
 * image_sizes  string  Optional. The `sizes` attribute for the background image. Default: 100vw.
 * action_text  string  Optional. Label for the call-to-action link.
 * action_href  string  Optional. URL for the call-to-action link. Default: #.
 *
 * ks_component( 'hero', [
 *   'heading'     => get_the_title(),
 *   'lead'        => get_field( 'standfirst' ),
 *   'image'       => get_post_thumbnail_id(),
 *   'image_sizes' => '100vw',
 *   'action_text' => 'Find out more',
 *   'action_href' => get_field( 'cta_url' ),
 * ] );
 */

$image_id = ks_image_id( $args['image'] ?? 0 );
?>
<div class="u-hero">
  <?php
  if ( $image_id ) {
    echo wp_get_attachment_image( $image_id, $args['image_size'] ?? 'hero', false, [
      'sizes'       => $args['image_sizes'] ?? '100vw',
      'alt'         => '',
      'aria-hidden' => 'true',
      'class'       => 'u-hero__bg-image',
      'loading'     => 'lazy',
    ] );
  }
  ?>
  <div class="wrapper">
    <div class="u-hero__content">
      <h1 class="u-hero__heading"><?php echo esc_html( $args['heading'] ?? '' ); ?></h1>
      <?php if ( ! empty( $args['lead'] ) ) : ?>
        <p class="u-hero__lead"><?php echo esc_html( $args['lead'] ); ?></p>
      <?php endif; ?>
      <?php
      if ( ! empty( $args['action_text'] ) ) {
        ks_component( 'link', [
          'text' => $args['action_text'],
          'href' => $args['action_href'] ?? '#',
        ] );
      }
      ?>
    </div>
  </div>
</div>
