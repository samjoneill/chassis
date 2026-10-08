<?php
/**
 * Video layout — renders components/video.php.
 */

ks_component( 'video', [
  'video_id' => get_sub_field( 'video_id' ),
  'caption'  => get_sub_field( 'caption' ),
] );
