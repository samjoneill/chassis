<?php
/**
 * Block Quote layout — renders components/block-quote.php.
 */

ks_component( 'block-quote', [
  'quote' => get_sub_field( 'quote' ),
] );
