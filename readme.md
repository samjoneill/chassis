
# Chassis

A starter framework for front-end projects, built around a Gulp-based CSS/JS pipeline using [CUBE CSS](https://cube.fyi/). Optionally bundles a pre-configured [Craft CMS](https://craftcms.com/) application skeleton, or an [Eleventy](https://www.11ty.dev/) static site skeleton, for projects that need one.

## Requirements

- Node.js (for the asset build)
- [DDEV](https://ddev.com/) and [Composer](https://getcomposer.org/) 2.x — only needed if you install Craft

## Installation

Run the [installer script](https://github.com/samjoneill/commands/blob/main/initproject) from your new project's root directory. It will ask:

```
What kind of project do you want to initialise?

  • craft     (Craft CMS + Twig templates)
  • eleventy  (Eleventy static site + Nunjucks templates)
  • no        (holding page — asset pipeline only)
```

- **craft** — merges the Craft application skeleton into the project root, copies `.env.example.dev` to `.env`, runs `composer install`, sets up DDEV (`ddev config` + `ddev start`), then automatically runs Craft's `ddev craft setup` wizard, which populates `CRAFT_APP_ID`, `CRAFT_SECURITY_KEY`, and `PRIMARY_SITE_URL` in `.env` and creates your admin account. It also installs the CKEditor plugin and opens the site in your browser.
- **eleventy** — merges the Eleventy skeleton into the project root and adds its build scripts/dependencies to `package.json`. `npm run build` runs the Gulp build followed by Eleventy, writing pages to `web/` next to Gulp's `web/assets/` (Gulp must run first, since its `clean` step would otherwise wipe Eleventy's optimised images); `npm run dev` runs both concurrently with live reload.
- **no** — discards both skeletons entirely, leaving just the asset pipeline (`src/`, `gulpfile.js`, `package.json`) for a static holding page.

Either way, the script also initialises Git, installs NPM packages, and runs an initial asset build.

For staging or production environments, copy `.env.example.staging` or `.env.example.production` to `.env` on that environment and fill in the values manually.

## Usage

- `npm run dev` — watches `src/` and rebuilds CSS/JS on change (`gulp watchFiles`).
- `npm run build` — produces the production asset build (`gulp build`).

## Structure

### `_craft/`

Craft CMS application skeleton — only present if you choose to install Craft, in which case its contents are moved into the project root during installation. Includes:

- `.ddev/` — local development environment config
- `.env.example.*` — environment variable templates for dev, staging, and production
- `composer.json` — Craft CMS, CKEditor, and SEOmatic dependencies
- `config/`, `migrations/`, `templates/`, `web/` — standard Craft application directories

### `_11ty/`

Eleventy static site skeleton — only present if you choose to install Eleventy, in which case its contents are moved into the project root during installation. Includes:

- `eleventy.config.js` — Eleventy config: Nunjucks as the template engine, output to `web/` (shared with Gulp's `web/assets/`), the [`@11ty/eleventy-img`](https://www.11ty.dev/docs/plugins/image/) HTML transform plugin (post-processes every rendered `<img>` tag into an optimised, responsive image — replacing Craft's image-transform macros, without the async/macro restrictions a shortcode-based approach would hit), a `date` filter, and a `uid()` global for components that need a unique DOM id
- `package.additions.json` — `scripts`/`devDependencies` merged into the root `package.json` at install time, then discarded
- `scripts/clean-eleventy-output.js` — clears stale Eleventy output from `web/` on every build without touching `web/assets/`
- `content/` — pages, a sample `articles` collection, a `content/images/` folder for content-authored images (article photos, avatars — kept separate from `src/img/`, which stays Gulp-only for icons/static UI assets), and `_includes/layouts/` + `_includes/components/`, the latter a Nunjucks port of every component in `_craft/templates/components/` (one macro per file, e.g. `{% from "components/_button.njk" import button %}`)

### `src/`

CSS, JavaScript, fonts, and images for the project, output by the Gulp build. CSS follows [CUBE CSS](https://cube.fyi/):

- `css/global/` — resets, variables, base typography
- `css/compositions/` — layout primitives (grid, cluster, center, wrapper, etc.)
- `css/blocks/` — components (buttons, forms, cards, tabs, etc.)
- `css/utilities/` — single-purpose overrides
- `js/` — application JavaScript, with third-party code in `js/vendor/`

### `gulpfile.js`

Configuration for the [Gulp](https://gulpjs.com/)-based asset preprocessor.

### `package.json`

Configuration for the asset preprocessor.
