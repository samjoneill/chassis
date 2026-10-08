<?php
/**
 * Feature Quote layout — renders components/feature-quote.php.
 */

ks_component( 'feature-quote', [
  'quote'  => get_sub_field( 'quote' ),
  'name'   => get_sub_field( 'name' ),
  'role'   => get_sub_field( 'role' ),
  'avatar' => get_sub_field( 'avatar' ),
] );
