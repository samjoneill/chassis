<?php
/**
 * Single posts and pages — port of _pages/_entry.twig.
 */

get_header();

while ( have_posts() ) :
  the_post();
  the_content();
  ks_flexible_components();
endwhile;

get_footer();
