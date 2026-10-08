# Adding a component

A checklist for adding a new component and making it available in the ACF **Components** flexible content field.

Replace `{component-name}` with the component's name in kebab-case (e.g. `text-callout`), and `{Component Name}` with its display name (e.g. `Text Callout`). Use the same `{component-name}` everywhere: components, layouts and CSS are picked up by matching file names, so nothing needs registering in `functions.php`, `inc/acf.php` or `global.css`.

Paths starting `src/` are at the project root, and `npm` commands run from there. All other paths are in this theme.

| Step | File | Required? |
| --- | --- | --- |
| 1 | `components/{component-name}.php` | Yes |
| 2 | `src/css/blocks/{component-name}.css` | If it needs styles |
| 3 | `acf-json/group_ks_components.json` (via the ACF UI) | To use it on pages |
| 4 | `layouts/{component-name}.php` | To use it on pages |
| 5 | `page-templates/components.php` | Yes |
| 6 | `README.md` (and `CLAUDE.md` where relevant) | Yes |
| – | `src/js/main.js` | Only if it needs JS behaviour |

## 1. Component: `components/{component-name}.php`

This file holds the markup. Arguments arrive in `$args`. Start with a docblock that lists each parameter (name, type, description, default) and gives a usage example.

```php
<?php
/**
 * {Component Name}
 * One-line description of the component.
 *
 * heading  string  The heading.
 * body     string  The body text.
 * style    string  Optional. One of: default, dark, brand. Default: default.
 *
 * ks_component( '{component-name}', [
 *   'heading' => 'Example heading',
 *   'body'    => 'Example body text.',
 * ] );
 */
?>
<div class="u-{component-name}" data-{component-name}-style="<?php echo esc_attr( $args['style'] ?? 'default' ); ?>">
  <?php if ( ! empty( $args['heading'] ) ) : ?><p class="u-{component-name}__heading"><?php echo esc_html( $args['heading'] ); ?></p><?php endif; ?>
  <?php if ( ! empty( $args['body'] ) ) : ?><p class="u-{component-name}__body"><?php echo esc_html( $args['body'] ); ?></p><?php endif; ?>
</div>
```

Conventions:

- **Escape everything.** Use `esc_html` for text, `esc_attr` for attributes and `esc_url` for URLs. Rich-text (HTML) parameters use `wp_kses_post`, but only where the component really needs HTML.
- **Images.** Take an attachment ID plus a registered size (`card`, `content`, `hero`, `avatar`), and render them with `ks_image` / `ks_image_set` from `inc/images.php`.
- **Other components.** Compose with `ks_component()`, e.g. `ks_component( 'button', [ 'label' => …, 'href' => … ] )`.
- **Classes.** Use `u-{component-name}` with BEM-style `__element` children. Express variants as `data-{component-name}-*` attributes.

You can now render the component in any template:

```php
ks_component( '{component-name}', [ … ] );
$html = ks_get_component( '{component-name}', [ … ] ); // as a string
```

## 2. Styles: `src/css/blocks/{component-name}.css`

`src/css/global.css` glob-imports `blocks/*.css`, so the file is included automatically. Expose a component's values as custom properties set from the design tokens in `src/css/global/variables.css`, and let variants override those properties:

```css
.u-{component-name} {
  --{component-name}-bg: var(--color-light--shade-10);
  --{component-name}-padding: var(--space-s);

  background-color: var(--{component-name}-bg);
  padding: var(--{component-name}-padding);
}

.u-{component-name}[data-{component-name}-style='dark'] {
  --{component-name}-bg: var(--color-dark);
}
```

Then run `npm run build`, or keep `npm run dev` running. Never edit `assets/`.

Check `src/css/compositions/` (`flow`, `cluster`, `grid`, …) and `src/css/utilities/` (`prose`, `visually-hidden`) before writing new layout CSS. They may already cover what you need.

## 3. ACF layout in the Components field group

In WP admin, open **ACF → Field Groups → Components** and add a layout to the flexible content field:

- **Label:** `{Component Name}`
- **Name:** `{component-name}`. This must exactly match the layout file name in step 4, because `ks_flexible_components()` renders each row with `get_template_part( 'layouts/' . get_row_layout() )`.
- **Sub fields:** one per component parameter that editors should control. Choose field types that match: Text/Textarea for plain text, WYSIWYG for rich text, Image (return format: ID) for images, Link for actions, Select for `style` variants.

Save the field group. ACF writes the change to `acf-json/group_ks_components.json`. Edit field groups in the UI, not by hand, so the JSON stays in sync.

## 4. Layout mapping: `layouts/{component-name}.php`

This file maps the row's sub fields onto the component's arguments:

```php
<?php
/**
 * {Component Name} layout — renders components/{component-name}.php.
 */

[ $action_text, $action_href ] = ks_acf_link( get_sub_field( 'action' ) ); // only for link fields

ks_component( '{component-name}', [
  'heading'     => get_sub_field( 'heading' ),
  'body'        => get_sub_field( 'body' ),
  'style'       => get_sub_field( 'style' ) ?: 'default',
  'action_text' => $action_text,
  'action_href' => $action_href,
] );
```

`ks_acf_link()` (in `inc/acf.php`) converts an ACF Link field into the `action_text` / `action_href` pair that components expect.

## 5. Component library: `page-templates/components.php`

Add a section that renders the component with its documented example arguments. Include one section per variant where that's useful:

```php
$section( '{Component Name}', function () {
  foreach ( [ 'default', 'dark', 'brand' ] as $style ) {
    ks_component( '{component-name}', [
      'heading' => 'Example heading',
      'body'    => 'Example body text.',
      'style'   => $style,
    ] );
  }
} );
```

## 6. Documentation

- `README.md`: add `{Component Name}` to the list of layouts under **Page components**.
- If the component accepts HTML (`wp_kses_post`), update the **Rich text** note in `README.md` and the matching line in `CLAUDE.md`.

## Checking it works

1. Run `npm run build`.
2. View a page that uses the **Component library** template and check the new section.
3. Edit a page, add a **{Component Name}** row under Components, fill it in, and view the page.
4. Confirm `acf-json/group_ks_components.json` changed and commit it along with the new files.
