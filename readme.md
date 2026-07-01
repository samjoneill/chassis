
# Chassis

A starter framework for front-end projects, built around a Gulp-based CSS/JS pipeline using [CUBE CSS](https://cube.fyi/). Optionally bundles a pre-configured [Craft CMS](https://craftcms.com/) application skeleton for projects that need a backend.

## Requirements

- Node.js (for the asset build)
- [DDEV](https://ddev.com/) and [Composer](https://getcomposer.org/) 2.x — only needed if you install Craft

## Installation

Run the [installer script](https://github.com/samjoneill/commands/blob/main/initproject) from your new project's root directory. It will ask:

```
Do you want to initialise a Craft project? (yes/no)

  • yes
  • no (holding page)
```

- **yes** — merges the Craft application skeleton into the project root, copies `.env.example.dev` to `.env`, runs `composer install`, sets up DDEV (`ddev config` + `ddev start`), then automatically runs Craft's `ddev craft setup` wizard, which populates `CRAFT_APP_ID`, `CRAFT_SECURITY_KEY`, and `PRIMARY_SITE_URL` in `.env` and creates your admin account. It also installs the CKEditor plugin and opens the site in your browser.
- **no** — discards the Craft skeleton entirely, leaving just the asset pipeline (`src/`, `gulpfile.js`, `package.json`) for a static holding page.

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
