<?php
/**
 * Data Table
 * A horizontally scrollable table with a scroll-shadow fade effect.
 *
 * columns  array   Array of column header strings.
 * rows     array   Array of row arrays, each containing cell value strings.
 * caption  string  Optional. Accessible label for the table region. Default: 'Scrollable data table'.
 *
 * ks_component( 'data-table', [
 *   'columns' => [ 'Name', 'Role', 'Department' ],
 *   'rows'    => [
 *     [ 'Alice Johnson', 'Lead Designer', 'Product' ],
 *     [ 'Ben Carter', 'Frontend Engineer', 'Engineering' ],
 *   ],
 * ] );
 */
?>
<div class="u-data-table-wrapper" role="region" aria-label="<?php echo esc_attr( $args['caption'] ?? 'Scrollable data table' ); ?>" tabindex="0">
  <table class="u-data-table">
    <thead>
      <tr>
        <?php foreach ( $args['columns'] ?? [] as $column ) : ?>
          <th scope="col"><?php echo esc_html( $column ); ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $args['rows'] ?? [] as $row ) : ?>
        <tr>
          <?php foreach ( $row as $cell ) : ?>
            <td><?php echo esc_html( $cell ); ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
