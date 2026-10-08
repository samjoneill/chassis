<?php
/**
 * Checkbox
 * A single checkbox input with a custom SVG control.
 * Use inside field-group for grouped checkboxes.
 *
 * value    string   The input id, name, and value attribute.
 * label    string   The visible label text.
 * name     string   Optional. Input name attribute. Defaults to value.
 * checked  boolean  Optional. Whether the checkbox is pre-checked. Default: false.
 *
 * ks_component( 'checkbox', [
 *   'value' => 'agree-terms',
 *   'label' => 'I agree to the terms and conditions',
 * ] );
 */

$value = $args['value'] ?? '';
?>
<label class="u-checkbox" for="<?php echo esc_attr( $value ); ?>">
  <input
    type="checkbox"
    id="<?php echo esc_attr( $value ); ?>"
    name="<?php echo esc_attr( $args['name'] ?? $value ); ?>"
    value="<?php echo esc_attr( $value ); ?>"
    <?php checked( ! empty( $args['checked'] ) ); ?>>
  <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
    <rect class="u-checkbox__bg" width="18" height="18" x="1" y="1" stroke="currentColor" fill="none" stroke-width="1" rx="2" ry="2"></rect>
    <polyline class="u-checkbox__checkmark" points="4,10 8,14 16,5" stroke="transparent" stroke-width="2" fill="none"></polyline>
  </svg>
  <span><?php echo esc_html( $args['label'] ?? '' ); ?></span>
</label>
