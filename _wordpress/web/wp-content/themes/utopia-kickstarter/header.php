<?php
/**
 * Opening layout — port of _layouts/skeleton.twig and the top of _layouts/default.twig.
 *
 * Favicons come from Settings → General → Site Icon, the RSS link from
 * automatic-feed-links, and <title> from title-tag support.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="referrer" content="no-referrer-when-downgrade" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header>
      <?php do_action( 'utopia_kickstarter_header' ); ?>
    </header>

    <main>
