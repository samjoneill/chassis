<?php
/**
 * Button layout — renders components/button.php.
 */

[ $label, $href ] = ks_acf_link( get_sub_field( 'link' ) );

ks_component( 'button', [
  'label'   => $label,
  'href'    => $href ?: '#',
  'variant' => get_sub_field( 'variant' ) ?: 'primary',
  'size'    => get_sub_field( 'size' ) ?: 'large',
  'ghost'   => (bool) get_sub_field( 'ghost' ),
] );
