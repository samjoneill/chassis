<?php
/**
 * Statistic
 * A prominent figure and description pair for highlighting key data points.
 *
 * figure       string  The main statistic value (e.g. '94%' or '2,400+').
 * description  string  A short label describing the statistic.
 * style        string  Optional. Visual style. One of: default, brand, dark. Default: default.
 *
 * ks_component( 'statistic', [
 *   'figure'      => '94%',
 *   'description' => 'Client satisfaction rate',
 *   'style'       => 'brand',
 * ] );
 */
?>
<div class="u-statistic" data-statistic-style="<?php echo esc_attr( $args['style'] ?? 'default' ); ?>">
  <p class="u-statistic__figure"><?php echo esc_html( $args['figure'] ?? '' ); ?></p>
  <p class="u-statistic__description"><?php echo esc_html( $args['description'] ?? '' ); ?></p>
</div>
