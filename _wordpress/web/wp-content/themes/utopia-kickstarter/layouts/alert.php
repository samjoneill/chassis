<?php
/**
 * Alert layout — renders components/alert.php.
 */

ks_component( 'alert', [
  'text'  => get_sub_field( 'text' ),
  'level' => get_sub_field( 'level' ) ?: 'info',
] );
