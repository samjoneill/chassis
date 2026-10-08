<?php
/**
 * Image layout — renders components/image.php.
 */

$image = get_sub_field( 'image' );

ks_component( 'image', [
  'file'    => $image,
  'size'    => 'content',
  'sizes'   => '(min-width: 60rem) 60rem, 100vw',
  'caption' => get_sub_field( 'caption' ) ?: ( $image ? wp_get_attachment_caption( $image ) : '' ),
] );
