# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Layout

A WordPress site built from Chassis's `_wordpress` skeleton and run with DDEV (docroot `web/`). All project code is in the classic theme at `web/wp-content/themes/utopia-kickstarter/`, plus the Chassis asset pipeline at the root (`src/`, `gulpfile.js`, `package.json`). WordPress core, plugins and uploads are gitignored.

The plugins are ACF PRO (installed with Composer from ACF's repo; see `composer.json`) and Classic Editor. The block editor is deliberately not used. The theme registers no custom post types; add them per project in ACF.

The theme reflects the Utopia Kickstarter Figma file: design tokens (using Utopia's fluid type and space scales), a library of `u-*` CSS components, an icon sprite, JS behaviours, and a PHP component for each design component. Those components can be used in templates or added to pages through an ACF flexible content field. The theme `README.md` lists things deliberately not included (SEO, favicon/manifest links).

## Commands

Run from the project root:

```bash
npm install
npm run build   # gulp: clean + compile src/ → the theme's assets/
npm run dev     # gulp watchFiles: rebuild on src/ changes
ddev wp <command>   # WP-CLI
```

The theme's `assets/` is build output and gitignored — it must be built after cloning, and `npm run build` wipes it first. There is no test or lint setup.

## Architecture

Theme paths below are relative to `web/wp-content/themes/utopia-kickstarter/`.

- **Frontend source is `src/`** at the project root (`css/`, `js/main.js`, `js/vendor/`, `img/`, `fonts/`). Gulp compiles `src/css/global.css` (postcss glob-import → `assets/css/main.css`) and bundles `src/js/main.js` with Rollup/Babel (→ `assets/js/bundle.js`), both in the theme. `inc/assets.php` enqueues those built files (versioned by mtime). Edit CSS under `src/css/`, never in `assets/`.
- **Components** (`components/*.php`) are the unit of markup. Render with `ks_component( 'name', [ ...args ] )` or get a string with `ks_get_component()` (both in `inc/components.php`; they wrap `get_template_part` and read `$args`). Each file's docblock documents its parameters; see the theme `README.md` for conventions. Only prose/accordion/tab `content` allows HTML (`wp_kses_post`); everything else is escaped.
- **Images** go through `ks_image` / `ks_image_set` (`inc/images.php`) using attachment IDs and registered sizes (`card`, `content`, `hero`, `avatar`).
- **Page components** (ACF PRO): the "Components" flexible content field (`acf-json/group_ks_components.json`, on pages) lets editors stack components below the content. `singular.php` and `front-page.php` call `ks_flexible_components()` (`inc/acf.php`), which renders each row via `layouts/<layout name>.php`; those map `get_sub_field()` values onto the matching component (use `ks_acf_link()` for link fields). Field groups and post types sync to/from `acf-json/` — edit them in the ACF UI so the JSON stays in sync (`ddev wp acf json sync` imports JSON changes). `inc/acf.php` hides the ACF admin unless `WP_ENVIRONMENT_TYPE` is `local` or `development` (DDEV sets `local` in `.ddev/config.yaml`), so field groups are only edited locally; deploying is covered in the theme's `docs/deploying.md`. Adding one = new component + a layout in the field group + `layouts/<name>.php`; full checklist in the theme's `docs/adding-a-component.md`.
- **Templates**: `header.php`/`footer.php` are empty hook points (`utopia_kickstarter_header`, `utopia_kickstarter_footer`); `front-page.php`, `singular.php`, `index.php`, `404.php` are the page templates. `singular.php` renders any post type, Components included, so a new type only needs a location rule on the Components field group (and its own `single-<type>.php` only if it needs a different layout). `page-templates/components.php` ("Component library") renders every component — update it when adding or changing a component.
- `functions.php` only requires `inc/{setup,assets,components,images,acf}.php`.
