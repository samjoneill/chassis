<?php
/**
 * Radio
 * A single radio button input with a custom SVG control.
 * Use inside field-group for grouped radio buttons, sharing a common `name`.
 *
 * value    string   The input id and value attribute.
 * label    string   The visible label text.
 * name     string   Optional. Input name attribute for grouping radios. Defaults to value.
 * checked  boolean  Optional. Whether this option is pre-selected. Default: false.
 *
 * ks_component( 'field-group', [
 *   'legend_text' => 'Size',
 *   'options'     => [
 *     [ 'radio', [ 'value' => 'size-s', 'label' => 'Small', 'name' => 'size' ] ],
 *     [ 'radio', [ 'value' => 'size-m', 'label' => 'Medium', 'name' => 'size' ] ],
 *     [ 'radio', [ 'value' => 'size-l', 'label' => 'Large', 'name' => 'size' ] ],
 *   ],
 * ] );
 */

$value = $args['value'] ?? '';
?>
<label class="u-radio" for="<?php echo esc_attr( $value ); ?>">
  <input
    type="radio"
    id="<?php echo esc_attr( $value ); ?>"
    name="<?php echo esc_attr( $args['name'] ?? $value ); ?>"
    value="<?php echo esc_attr( $value ); ?>"
    <?php checked( ! empty( $args['checked'] ) ); ?>>
  <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
    <circle class="u-radio__bg" cx="10" cy="10" r="9" stroke="currentColor" fill="none" stroke-width="1"></circle>
    <circle class="u-radio__checkmark" cx="10" cy="10" r="5" fill="white"></circle>
  </svg>
  <span><?php echo esc_html( $args['label'] ?? '' ); ?></span>
</label>
