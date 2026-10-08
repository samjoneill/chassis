<?php
/**
 * Single posts and pages, of any post type: the content, then page components.
 */

get_header();

while ( have_posts() ) :
  the_post();
  the_content();
  ks_flexible_components();
endwhile;

get_footer();
