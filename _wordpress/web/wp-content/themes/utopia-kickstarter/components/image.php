<?php
/**
 * Image
 * A responsive image wrapped in a <figure>, with an optional caption.
 *
 * file     int     Attachment ID.
 * size     string  Optional. Registered image size used for src. Default: content.
 * sizes    string  Optional. The `sizes` attribute.
 * alt      string  Optional. Fallback alt text if the attachment has none set.
 * caption  string  Optional. Caption text, rendered as a <figcaption>.
 *
 * ks_component( 'image', [
 *   'file'    => $attachment_id,
 *   'size'    => 'content',
 *   'sizes'   => '(min-width: 60rem) 800px, 100vw',
 *   'caption' => wp_get_attachment_caption( $attachment_id ),
 * ] );
 */
?>
<figure class="u-image">
  <?php echo ks_image_set( ks_image_id( $args['file'] ?? 0 ), $args['size'] ?? 'content', $args['sizes'] ?? '', $args['alt'] ?? '', 'u-image__media' ); ?>
  <?php if ( ! empty( $args['caption'] ) ) : ?>
    <figcaption class="u-caption"><?php echo esc_html( $args['caption'] ); ?></figcaption>
  <?php endif; ?>
</figure>
