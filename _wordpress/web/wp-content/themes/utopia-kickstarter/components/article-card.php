<?php
/**
 * Article Card
 * A card component for linking to articles or news items.
 *
 * image           int     Attachment ID for the card image.
 * image_size      string  Optional. Registered image size used for src. Default: card.
 * image_sizes     string  Optional. The `sizes` attribute for the image.
 * image_alt       string  Optional. Fallback alt text if the attachment has none set.
 * heading         string  Card heading.
 * layout          string  Optional. Card layout. One of: standard, wide. Default: standard.
 * mode            string  Optional. Content treatment. One of: open, inset-light, inset-dark. Default: open.
 * image_position  string  Optional. Image position in wide layout. One of: start, end. Default: start.
 * meta            string  Optional. Metadata text (e.g. publication date).
 * body            string  Optional. Short description text.
 * action_text     string  Optional. Label for the action link.
 * action_href     string  Optional. URL for the action link. Default: #.
 *
 * ks_component( 'article-card', [
 *   'image'       => get_post_thumbnail_id(),
 *   'image_size'  => 'card',
 *   'image_sizes' => '(min-width: 40rem) 50vw, 100vw',
 *   'heading'     => get_the_title(),
 *   'meta'        => get_the_date( 'd M Y' ),
 *   'body'        => get_the_excerpt(),
 *   'action_text' => 'Read more',
 *   'action_href' => get_permalink(),
 * ] );
 */

$layout         = $args['layout'] ?? 'standard';
$mode           = $args['mode'] ?? 'open';
$image_position = $args['image_position'] ?? 'start';
$image_id       = ks_image_id( $args['image'] ?? 0 );

$image_el = function () use ( $args, $image_id ) {
  if ( ! $image_id ) {
    return;
  }
  ?>
  <div class="u-article-card__image-wrapper">
    <?php echo ks_image_set( $image_id, $args['image_size'] ?? 'card', $args['image_sizes'] ?? '', $args['image_alt'] ?? '', 'u-article-card__image' ); ?>
  </div>
  <?php
};

$content_el = function () use ( $args ) {
  ?>
  <div class="u-article-card__content">
    <?php if ( ! empty( $args['meta'] ) ) : ?>
      <p class="u-article-card__meta"><?php echo esc_html( $args['meta'] ); ?></p>
    <?php endif; ?>
    <h3 class="u-article-card__heading"><?php echo esc_html( $args['heading'] ?? '' ); ?></h3>
    <?php if ( ! empty( $args['body'] ) ) : ?>
      <p class="u-article-card__body"><?php echo esc_html( $args['body'] ); ?></p>
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
  <?php
};
?>
<article class="u-article-card"
  data-article-card-mode="<?php echo esc_attr( $mode ); ?>"
  <?php if ( 'wide' === $layout ) : ?>
  data-article-card-layout="wide"
  data-article-card-img-pos="<?php echo esc_attr( $image_position ); ?>"
  <?php endif; ?>>
  <?php
  if ( 'wide' === $layout && 'end' === $image_position ) {
    $content_el();
    $image_el();
  } else {
    $image_el();
    $content_el();
  }
  ?>
</article>
