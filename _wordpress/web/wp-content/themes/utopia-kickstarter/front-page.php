<?php
/**
 * Front page.
 */

get_header();

while ( have_posts() ) :
  the_post();
  the_content();
  ks_flexible_components();
endwhile;

get_footer();
