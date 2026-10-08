<?php
/**
 * Alert
 * An inline status message with a coloured left border and icon.
 *
 * text   string  The alert message.
 * level  string  Optional. Severity level. One of: info, warning, success, failure. Default: info.
 *
 * ks_component( 'alert', [
 *   'text'  => 'Your changes have been saved.',
 *   'level' => 'success',
 * ] );
 */

$level   = $args['level'] ?? 'info';
$icon_id = 'warning' === $level ? 'caution' : $level;
?>
<div class="u-alert" data-alert-level="<?php echo esc_attr( $level ); ?>" role="alert">
  <span class="u-alert__icon">
    <?php ks_component( 'icon', [ 'id' => $icon_id ] ); ?>
  </span>
  <p class="u-alert__text"><?php echo esc_html( $args['text'] ?? '' ); ?></p>
</div>
