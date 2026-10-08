<?php
/**
 * Field Group
 * A fieldset wrapper for grouping related inputs (checkboxes, radios).
 * Child inputs are passed as `options`: a list of [ component, args ] pairs.
 *
 * legend_text  string  The visible group label, rendered as a <legend>.
 * hint_text    string  Optional. Supporting hint text shown below the legend.
 * options      array   List of [ component name, component args ] pairs.
 *
 * ks_component( 'field-group', [
 *   'legend_text' => 'Preferred contact method',
 *   'hint_text'   => 'Select one option.',
 *   'options'     => [
 *     [ 'radio', [ 'value' => 'contact-email', 'label' => 'Email', 'name' => 'contact-method' ] ],
 *     [ 'radio', [ 'value' => 'contact-phone', 'label' => 'Phone', 'name' => 'contact-method' ] ],
 *   ],
 * ] );
 */
?>
<fieldset class="u-field-group">
  <legend class="u-label"><?php echo esc_html( $args['legend_text'] ?? '' ); ?></legend>
  <?php if ( ! empty( $args['hint_text'] ) ) : ?>
    <p class="u-hint"><?php echo esc_html( $args['hint_text'] ); ?></p>
  <?php endif; ?>
  <div class="u-field-group__options">
    <?php
    foreach ( $args['options'] ?? [] as [ $component, $component_args ] ) {
      ks_component( $component, $component_args );
    }
    ?>
  </div>
</fieldset>
