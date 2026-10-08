<?php
/**
 * Fallback template — lists posts, with pagination.
 */

get_header();
?>

<div class="wrapper flow">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php
      ks_component( 'article-card', [
        'image'       => get_post_thumbnail_id(),
        'image_size'  => 'card',
        'image_sizes' => '(min-width: 40rem) 50vw, 100vw',
        'heading'     => get_the_title(),
        'meta'        => get_the_date( 'd M Y' ),
        'body'        => get_the_excerpt(),
        'action_text' => __( 'Read more', 'utopia-kickstarter' ),
        'action_href' => get_permalink(),
      ] );
      ?>
    <?php endwhile; ?>

    <?php
    $pagination = ks_pagination_args();
    if ( $pagination ) {
      ks_component( 'pagination', $pagination );
    }
    ?>
  <?php else : ?>
    <p><?php esc_html_e( 'Nothing found.', 'utopia-kickstarter' ); ?></p>
  <?php endif; ?>
</div>

<?php
get_footer();
