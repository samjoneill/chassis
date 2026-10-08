<?php
/**
 * Hero layout — renders components/hero.php.
 */

[ $action_text, $action_href ] = ks_acf_link( get_sub_field( 'action' ) );

ks_component( 'hero', [
  'heading'     => get_sub_field( 'heading' ),
  'lead'        => get_sub_field( 'lead' ),
  'image'       => get_sub_field( 'image' ),
  'action_text' => $action_text,
  'action_href' => $action_href,
] );
