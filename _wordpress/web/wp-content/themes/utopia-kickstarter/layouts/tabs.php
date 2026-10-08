<?php
/**
 * Tabs layout — renders components/tabs.php.
 */

ks_component( 'tabs', [
  'tabs'    => get_sub_field( 'tabs' ) ?: [],
  'variant' => get_sub_field( 'variant' ) ?: '1',
  'label'   => get_sub_field( 'label' ) ?: 'Content',
  'id'      => wp_unique_id( 'tabs-' ),
] );
