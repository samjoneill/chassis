<?php
/**
 * Text Callout layout — renders components/text-callout.php.
 */

[ $action_text, $action_href ] = ks_acf_link( get_sub_field( 'action' ) );

ks_component( 'text-callout', [
  'heading'     => get_sub_field( 'heading' ),
  'body'        => get_sub_field( 'body' ),
  'style'       => get_sub_field( 'style' ) ?: 'default',
  'action_text' => $action_text,
  'action_href' => $action_href,
] );
