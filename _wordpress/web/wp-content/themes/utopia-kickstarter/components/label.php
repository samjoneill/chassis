<?php
/**
 * Label
 * A styled <label> element for associating with a form input.
 *
 * text  string  The visible label text.
 * id    string  The id of the associated input (used as the `for` attribute).
 *
 * ks_component( 'label', [
 *   'text' => 'Email address',
 *   'id'   => 'email',
 * ] );
 */
?>
<label class="u-label" for="<?php echo esc_attr( $args['id'] ?? '' ); ?>"><?php echo esc_html( $args['text'] ?? '' ); ?></label>
