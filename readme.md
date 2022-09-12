
# Chassis

## Installer

Use the [installer bash script](https://github.com/samjoneill/commands/blob/main/initproject) to install the Chassis framework.

## Structure

### `_craft/`

App skeleton for Craft CMS projects.

### `raw/`

The CSS framework, default JavaScript polyfills and libraries, and some icon fonts.

### `.eslintrc.yml` and `.sass-lint.yml`

Configuration files for javascript and SCSS linting, respectively. You should only need to touch these for legacy projects.

### `gulpfile.js`

Configuration for our [Gulp](https://gulpjs.com/)-based asset preprocessor. Available commands (run with `yarn [command]`):

- `build` Delete all processed assets, then re-process all raw files.
- `build:js` Re-process all raw javascript.
- `build:css` Re-process all raw SCSS.
- `build:img` Re-process all raw images.
- `build:fonts` Re-process all raw fonts.
- `watch` Reprocess files and notify livereload when a change is detected (CTRL-C to exit).

### `package.json`

Configuration for the framework asset preprocessor. Switch production mode on and off in here.

## CSS framework

- `main.scss` Contains all imports. This is the file that will get processed.
- `variables.scss` Sass configuration file, where *all* variables are set.
- `static/` Framework tools - shouldn't need to edit these, they're all managed with variables.
	- `flex-media.scss` Responsive images, videos, iframes.
	- `font-faces.scss` Font-face rule generator.
	- `icons.scss` Icon rule generator.
	- `mixins.scss` Useful Sass mixins.
	- `reset.scss` HTML5 reset.
	- `todo.scss` TODO styles.
	- `widths.scss` Breakpoint width class generator.
- `site/` Site-specific styles. Feel free to add more files/folders to this folder if you want to split things up further.
	- `components/` Where all component files should be kept.
	- `container.scss` Container class to constrain site width.
	- `flex.scss` Flexbox helper classes.
	- `grid.scss` Grid system.
	- `helpers.scss` Useful classes.
	- `site.scss` A blank canvas. The only limit is your imagination.
	- `typeset.scss` Typography styles, font sizes, and the `.typeset` system.
- `vendor/` External vendor styles (e.g. lightboxes, slideshows).

Do not add your own top-level folders here. All non-framework non-vendor SCSS files and folders should live inside `site/`.

## Javascript framework

- `main.js` Runs after all libs are imported, in the document footer. Your site-wide javascript lives here, and will be minified in production mode.
- `helpers.js` A place to store small helper functions that you don't want cluttering `main.js`.
- `vendor/` All external libraries not in the NPM repository should be downloaded and placed in here.
- `vendor-solo/` Libraries that need to remain separate go in here. They will be transferred to the public assets folder unchanged.
