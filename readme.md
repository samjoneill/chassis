
# Chassis

## Installation

Use the [installer script](https://github.com/samjoneill/commands/blob/main/initproject) to install the Chassis framework.

## Structure

### `_craft/`

App skeleton for Craft CMS projects.

### `src/`

The CSS framework, default JavaScript polyfills and libraries, and some icon fonts.

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

## Javascript framework
