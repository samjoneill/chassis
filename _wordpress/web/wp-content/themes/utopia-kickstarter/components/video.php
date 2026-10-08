<?php
/**
 * Video
 * A responsive YouTube embed using the privacy-enhanced nocookie domain,
 * wrapped in a <figure> with an optional caption.
 *
 * video_id  string  The YouTube video ID (the part after ?v= in the watch URL).
 * caption   string  Optional. Caption text, rendered as a <figcaption>.
 *
 * ks_component( 'video', [
 *   'video_id' => get_field( 'video_id' ),
 *   'caption'  => get_field( 'video_caption' ),
 * ] );
 */
?>
<figure class="u-video">
  <div class="u-video__embed-wrapper">
    <iframe
      class="u-video__embed"
      src="<?php echo esc_url( 'https://www.youtube-nocookie.com/embed/' . rawurlencode( $args['video_id'] ?? '' ) ); ?>"
      title="Embedded YouTube video"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      allowfullscreen
      loading="lazy"></iframe>
  </div>
  <?php if ( ! empty( $args['caption'] ) ) : ?>
    <figcaption class="u-caption"><?php echo esc_html( $args['caption'] ); ?></figcaption>
  <?php endif; ?>
</figure>
