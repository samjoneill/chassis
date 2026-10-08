<?php
/**
 * Prose layout — renders components/prose.php.
 */

ks_component( 'prose', [
  'content' => get_sub_field( 'content' ),
  'width'   => get_sub_field( 'width' ) ?: 'default',
] );
