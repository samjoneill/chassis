<?php
/**
 * Template Name: Component library
 *
 * Renders every component with its documented example args — the WordPress
 * stand-in for Storybook / preview-skeleton.twig. Image components use the
 * most recent image in the media library when one exists.
 */

get_header();

$sample_image = get_posts( [
  'post_type'      => 'attachment',
  'post_mime_type' => 'image',
  'posts_per_page' => 1,
  'fields'         => 'ids',
] )[0] ?? 0;

$section = function ( string $title, callable $render ) {
  ?>
  <section class="flow">
    <h2><?php echo esc_html( $title ); ?></h2>
    <?php $render(); ?>
  </section>
  <?php ks_component( 'horizontal-rule' ); ?>
  <?php
};
?>

<?php
if ( $sample_image ) {
  ks_component( 'hero', [
    'heading'     => 'Component library',
    'lead'        => 'Every Utopia Kickstarter component rendered with its documented example arguments.',
    'image'       => $sample_image,
    'action_text' => 'Find out more',
    'action_href' => '#components',
  ] );
} else {
  ks_component( 'hero', [
    'heading'     => 'Component library',
    'lead'        => 'Every Utopia Kickstarter component rendered with its documented example arguments. Upload an image to the media library to preview image components.',
    'action_text' => 'Find out more',
    'action_href' => '#components',
  ] );
}
?>

<div class="wrapper flow" id="components">

  <?php
  $section( 'Alert', function () {
    foreach ( [ 'info', 'warning', 'success', 'failure' ] as $level ) {
      ks_component( 'alert', [ 'text' => ucfirst( $level ) . ': your changes have been saved.', 'level' => $level ] );
    }
  } );

  $section( 'Button', function () {
    ?>
    <div class="cluster">
      <?php
      ks_component( 'button', [ 'label' => 'Primary' ] );
      ks_component( 'button', [ 'label' => 'Outline', 'variant' => 'outline' ] );
      ks_component( 'button', [ 'label' => 'Ghost', 'ghost' => true ] );
      ks_component( 'button', [ 'label' => 'Small link', 'size' => 'small', 'href' => '#' ] );
      ?>
    </div>
    <?php
  } );

  $section( 'Link', function () {
    ks_component( 'link', [ 'text' => 'Read the full report', 'href' => '#' ] );
  } );

  $section( 'Text callout', function () {
    foreach ( [ 'default', 'dark', 'brand' ] as $style ) {
      ks_component( 'text-callout', [
        'heading'     => 'Did you know?',
        'body'        => 'We offer a free consultation for all new clients.',
        'action_text' => 'Book a consultation',
        'action_href' => '#',
        'style'       => $style,
      ] );
    }
  } );

  $section( 'Statistic', function () {
    ?>
    <div class="grid">
      <?php
      foreach ( [ 'default', 'brand', 'dark' ] as $style ) {
        ks_component( 'statistic', [ 'figure' => '94%', 'description' => 'Client satisfaction rate', 'style' => $style ] );
      }
      ?>
    </div>
    <?php
  } );

  $section( 'USP', function () {
    ks_component( 'usp', [
      'heading'     => 'No hidden fees',
      'description' => 'Our pricing is fully transparent. What you see is what you pay.',
    ] );
  } );

  $section( 'Quotes', function () use ( $sample_image ) {
    ks_component( 'block-quote', [ 'quote' => 'Design is not just what it looks like. Design is how it works.' ] );
    ks_component( 'feature-quote', [
      'quote'  => 'Working with this team transformed our approach entirely.',
      'name'   => 'Jane Smith',
      'role'   => 'Title, Company Ltd',
      'avatar' => $sample_image,
    ] );
  } );

  $section( 'Prose', function () {
    ks_component( 'prose', [
      'content' => '<h2>A heading</h2><p>Rich text with <a href="#">a link</a>, <strong>bold</strong> and <em>italic</em> text.</p><h3>A subheading</h3><ul><li>First item</li><li>Second item</li></ul><blockquote><p>A quotation.</p></blockquote>',
    ] );
  } );

  $section( 'Accordion', function () {
    ks_component( 'accordion', [
      'items' => [
        [ 'title' => 'First section', 'content' => 'Content for the first section.' ],
        [ 'title' => 'Second section', 'content' => 'Content for the second section.' ],
      ],
    ] );
  } );

  $section( 'Tabs', function () {
    foreach ( [ '1', '2', '3' ] as $variant ) {
      ks_component( 'tabs', [
        'tabs'    => [
          [ 'label' => 'Overview', 'content' => 'Overview content here.' ],
          [ 'label' => 'Details', 'content' => 'Details content here.' ],
          [ 'label' => 'FAQs', 'content' => 'FAQ content here.' ],
        ],
        'variant' => $variant,
        'label'   => 'Product information',
      ] );
    }
  } );

  $section( 'Lists', function () {
    ks_component( 'unordered-list', [
      'items' => [ 'Free initial consultation', 'Dedicated account manager', 'Monthly progress reports' ],
    ] );
    ks_component( 'ordered-list', [
      'items' => [ 'Submit the enquiry form.', 'We will be in touch within two working days.', 'An advisor will arrange a call with you.' ],
    ] );
  } );

  $section( 'Data table', function () {
    ks_component( 'data-table', [
      'columns' => [ 'Name', 'Role', 'Department' ],
      'rows'    => [
        [ 'Alice Johnson', 'Lead Designer', 'Product' ],
        [ 'Ben Carter', 'Frontend Engineer', 'Engineering' ],
      ],
    ] );
  } );

  $section( 'Article card', function () use ( $sample_image ) {
    $card = [
      'image'       => $sample_image,
      'image_sizes' => '(min-width: 40rem) 50vw, 100vw',
      'heading'     => 'Article heading',
      'meta'        => wp_date( 'd M Y' ),
      'body'        => 'A short description of the article.',
      'action_text' => 'Read more',
      'action_href' => '#',
    ];
    ?>
    <div class="grid">
      <?php
      foreach ( [ 'open', 'inset-light', 'inset-dark' ] as $mode ) {
        ks_component( 'article-card', $card + [ 'mode' => $mode ] );
      }
      ?>
    </div>
    <?php
    ks_component( 'article-card', $card + [ 'layout' => 'wide' ] );
    ks_component( 'article-card', $card + [ 'layout' => 'wide', 'image_position' => 'end' ] );
  } );

  $section( 'Media', function () use ( $sample_image ) {
    if ( $sample_image ) {
      ks_component( 'image', [ 'file' => $sample_image, 'caption' => 'Figure 1: An example image.' ] );
    }
    ks_component( 'video', [ 'video_id' => 'aqz-KE-bpKQ', 'caption' => 'An example video.' ] );
    ks_component( 'caption', [ 'text' => 'Figure 1: Quarterly revenue by region.' ] );
  } );

  $section( 'Pagination', function () {
    ks_component( 'pagination', [ 'pages' => 5, 'current_page' => 2 ] );
  } );

  $section( 'Form', function () {
    ks_component( 'text-input', [
      'id'            => 'demo-error',
      'label_text'    => 'Input with error',
      'hint_text'     => 'Hint text',
      'has_error'     => true,
      'error_message' => 'Enter a valid value',
    ] );
    ks_component( 'form' );
  } );

  $section( 'Icons', function () {
    ?>
    <div class="cluster">
      <?php
      $ids = [ 'arrow-up', 'arrow-right', 'arrow-down', 'arrow-left', 'log-out', 'download', 'chevron-up', 'chevron-down', 'chevron-left', 'chevron-right', 'calendar', 'mail', 'phone', 'menu', 'search', 'tick', 'cross', 'info', 'caution', 'user', 'add', 'rss', 'success', 'failure', 'button-arrow' ];
      foreach ( $ids as $id ) {
        ks_component( 'icon', [ 'id' => $id ] );
      }
      ?>
    </div>
    <?php
  } );
  ?>

</div>

<?php
get_footer();
