<?php
/**
 * Statistic layout — renders components/statistic.php.
 */

ks_component( 'statistic', [
  'figure'      => get_sub_field( 'figure' ),
  'description' => get_sub_field( 'description' ),
  'style'       => get_sub_field( 'style' ) ?: 'default',
] );
