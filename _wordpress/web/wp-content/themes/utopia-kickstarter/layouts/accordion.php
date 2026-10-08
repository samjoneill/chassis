<?php
/**
 * Accordion layout — renders components/accordion.php.
 */

ks_component( 'accordion', [
  'items' => get_sub_field( 'items' ) ?: [],
] );
