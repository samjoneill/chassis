<?php
/**
 * Select
 * A custom-styled select input with label and optional hint and error state.
 *
 * id             string   The input id and name attribute.
 * label_text     string   The visible label text.
 * items          array    Array of arrays with `value` (string) and `label` (string).
 * hint_text      string   Optional. Supporting hint text shown below the label.
 * disabled       boolean  Optional. Disables the input. Default: false.
 * has_error      boolean  Optional. Applies error styles. Default: false.
 * error_message  string   Optional. Error message shown when has_error is true. Default: 'Error message text'.
 *
 * ks_component( 'select', [
 *   'id'         => 'country',
 *   'label_text' => 'Country',
 *   'items'      => [
 *     [ 'value' => '', 'label' => 'Select a country…' ],
 *     [ 'value' => 'gb', 'label' => 'United Kingdom' ],
 *     [ 'value' => 'us', 'label' => 'United States' ],
 *   ],
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
  <div class="u-select<?php echo $has_error ? ' u-select--error' : ''; ?>">
    <select
      id="<?php echo esc_attr( $id ); ?>"
      name="<?php echo esc_attr( $id ); ?>"
      <?php disabled( ! empty( $args['disabled'] ) ); ?>>
      <?php foreach ( $args['items'] ?? [] as $item ) : ?>
        <option value="<?php echo esc_attr( $item['value'] ?? '' ); ?>"><?php echo esc_html( $item['label'] ?? '' ); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php if ( $has_error ) : ?>
    <p class="u-select-error"><?php echo esc_html( $args['error_message'] ?? 'Error message text' ); ?></p>
  <?php endif; ?>
</div>
