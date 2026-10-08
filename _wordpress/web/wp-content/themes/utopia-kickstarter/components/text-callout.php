<?php
/**
 * Text Callout
 * A boxed callout with a heading, body text, and optional action link.
 *
 * heading      string  The callout heading.
 * body         string  The callout body text.
 * style        string  Optional. Visual style. One of: default, dark, brand. Default: default.
 * action_text  string  Optional. Label for the action link. Omit to hide the link.
 * action_href  string  Optional. URL for the action link. Default: #.
 *
 * ks_component( 'text-callout', [
 *   'heading'     => 'Did you know?',
 *   'body'        => 'We offer a free consultation for all new clients.',
 *   'action_text' => 'Book a consultation',
 *   'action_href' => '/contact',
 *   'style'       => 'brand',
 * ] );
 */
?>
<div class="u-text-callout" data-text-callout-style="<?php echo esc_attr( $args['style'] ?? 'default' ); ?>">
  <?php if ( ! empty( $args['heading'] ) ) : ?><p class="u-text-callout__heading"><?php echo esc_html( $args['heading'] ); ?></p><?php endif; ?>
  <?php if ( ! empty( $args['body'] ) ) : ?><p class="u-text-callout__body"><?php echo esc_html( $args['body'] ); ?></p><?php endif; ?>
  <?php
  if ( ! empty( $args['action_text'] ) ) {
    ks_component( 'button', [
      'label' => $args['action_text'],
      'href'  => $args['action_href'] ?? '#',
    ] );
  }
  ?>
</div>
