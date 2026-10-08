<?php
/**
 * Textarea
 * A multi-line text input with label and optional hint and error state.
 *
 * id                 string   The textarea id and name attribute.
 * label_text         string   The visible label text.
 * hint_text          string   Optional. Supporting hint text shown below the label.
 * input_placeholder  string   Optional. Placeholder text.
 * rows               int      Optional. Number of visible rows. Default: 4.
 * disabled           boolean  Optional. Disables the input. Default: false.
 * has_error          boolean  Optional. Applies error styles. Default: false.
 * error_message      string   Optional. Error message shown when has_error is true. Default: 'Error message text'.
 *
 * ks_component( 'textarea', [
 *   'id'         => 'message',
 *   'label_text' => 'Your message',
 *   'hint_text'  => 'Maximum 500 characters.',
 *   'rows'       => 6,
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
  <textarea
    class="u-textarea<?php echo $has_error ? ' u-textarea--error' : ''; ?>"
    id="<?php echo esc_attr( $id ); ?>"
    name="<?php echo esc_attr( $id ); ?>"
    rows="<?php echo (int) ( $args['rows'] ?? 4 ); ?>"
    <?php if ( ! empty( $args['input_placeholder'] ) ) : ?>placeholder="<?php echo esc_attr( $args['input_placeholder'] ); ?>"<?php endif; ?>
    <?php disabled( ! empty( $args['disabled'] ) ); ?>></textarea>
  <?php if ( $has_error ) : ?>
    <p class="u-textarea-error"><?php echo esc_html( $args['error_message'] ?? 'Error message text' ); ?></p>
  <?php endif; ?>
</div>
