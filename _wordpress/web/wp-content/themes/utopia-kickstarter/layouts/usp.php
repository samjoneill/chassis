<?php
/**
 * USP layout — renders components/usp.php.
 */

ks_component( 'usp', [
  'heading'     => get_sub_field( 'heading' ),
  'description' => get_sub_field( 'description' ),
] );
