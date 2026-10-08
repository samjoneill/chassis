<?php
/**
 * Front page — port of _pages/index.twig.
 */

get_header();

while ( have_posts() ) :
  the_post();
  the_content();
  ks_flexible_components();
endwhile;

get_footer();
