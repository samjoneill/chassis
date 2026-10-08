<?php
/**
 * Closing layout: ends <main>, then the site footer and wp_footer().
 */
?>
    </main>

    <footer>
      <?php do_action( 'utopia_kickstarter_footer' ); ?>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>
