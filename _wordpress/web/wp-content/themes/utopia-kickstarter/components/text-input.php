<?php
/**
 * Text Input
 * A single-line text input with label and optional hint and error state.
 *
 * id                 string   The input id and name attribute.
 * label_text         string   The visible label text.
 * input_type         string   Optional. HTML input type (text, email, tel, etc.). Default: text.
 * input_placeholder  string   Optional. Placeholder text for the input.
 * hint_text          string   Optional. Supporting hint text shown below the label.
 * disabled           boolean  Optional. Disables the input. Default: false.
 * has_error          boolean  Optional. Applies error styles. Default: false.
 * error_message      string   Optional. Error message shown when has_error is true. Default: 'Error message text'.
 *
 * ks_component( 'text-input', [
 *   'id'         => 'email',
 *   'label_text' => 'Email address',
 *   'input_type' => 'email',
 * ] );
 */

$id        = $args['id'] ?? '';
$has_error = ! empty( $args['has_error'] );
?>
<div>
  <label class="u-label" for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $args['label_text'] ?? '' ); ?></label>
  <?php if ( ! empty( $args['hint_text'] ) ) : ?>
    <p class="u-hint"><?php echo esc_html( $args['hint_text'] ); ?></p>
  <?php endif; ?>
  <input
    class="u-text-input<?php echo $has_error ? ' u-text-input--error' : ''; ?>"
    type="<?php echo esc_attr( $args['input_type'] ?? 'text' ); ?>"
    id="<?php echo esc_attr( $id ); ?>"
    name="<?php echo esc_attr( $id ); ?>"
    <?php if ( ! empty( $args['input_placeholder'] ) ) : ?>placeholder="<?php echo esc_attr( $args['input_placeholder'] ); ?>"<?php endif; ?>
    <?php disabled( ! empty( $args['disabled'] ) ); ?>>
  <?php if ( $has_error ) : ?>
    <p class="u-text-input-error"><?php echo esc_html( $args['error_message'] ?? 'Error message text' ); ?></p>
  <?php endif; ?>
</div>
