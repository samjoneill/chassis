# Starting a new site

New WordPress sites start from [Chassis](https://github.com/samjoneill/chassis): run [`initproject`](https://github.com/samjoneill/commands) in an empty project folder and choose `wordpress`. Pass it your ACF PRO licence key (see [The ACF PRO licence key](#the-acf-pro-licence-key)). The script does everything below. The steps are written out so you know what it did, and so you can do the same by hand.

The theme is a starter, copied into each project and changed to suit. It is not a parent theme, so changes on one site don't reach others. Improvements worth keeping go back into `_wordpress` in Chassis.

## Requirements

- [DDEV](https://ddev.com/), Node and [Composer](https://getcomposer.org/)
- **ACF PRO** (`advanced-custom-fields-pro`): provides the Components flexible content field. Without it, the theme still renders, but pages have no Components field.
- **Classic Editor** (`classic-editor`): the block editor is deliberately not used.

## Project layout

```
.ddev/                           DDEV config (WordPress, docroot web/)
composer.json                    ACF PRO, from ACF's Composer repo
src/, gulpfile.js, package.json  Chassis asset pipeline
web/                             WordPress (core isn't committed)
  wp-content/themes/utopia-kickstarter/
```

The whole project is one git repo. WordPress core, plugins, uploads and built assets are gitignored. The theme, `src/` and the config files are committed.

## 1. Chassis and the WordPress skeleton

Clone Chassis into the project, move the contents of `_wordpress/` to the project root, and delete `_craft/` and `_11ty/`.

## 2. Rename the theme

Replace the starter's name and slugs with the project's, and rename the theme folder to match:

| Find | Replace with | Where |
| --- | --- | --- |
| `Utopia Kickstarter` | Project name | `style.css` (Theme Name), `functions.php`, `README.md`, `page-templates/components.php` |
| `utopia-kickstarter` | Project slug (kebab-case) | Theme folder name, `style.css` (Text Domain), translation calls in templates and `inc/`, asset handles in `inc/assets.php`, paths in `CLAUDE.md` |
| `utopia_kickstarter` | Project slug (snake_case) | Hook names in `header.php`, `footer.php` and `README.md` |

Also update `Author` and `Description` in `style.css`.

The `ks_` prefix on PHP functions and ACF keys can stay. It's generic, and renaming the ACF keys would break the field groups.

## 3. Point the build at the theme

Chassis builds to `web/assets/`. For WordPress, change every `web/assets` in `gulpfile.js` to `web/wp-content/themes/<slug>/assets`, so the theme loads its CSS, JS, images and fonts from its own `assets/` folder. Then:

```bash
npm install
npm run build
```

## 4. WordPress and plugins

```bash
ddev config --project-type=wordpress --docroot=web
ddev start
ddev wp core download --skip-content
ddev wp core install --url='$DDEV_PRIMARY_URL' --title="Site name" --admin_user=admin --admin_email=you@example.com
ddev wp rewrite structure '/%postname%/'
composer require wpengine/advanced-custom-fields-pro
ddev wp plugin activate advanced-custom-fields-pro
ddev wp plugin install classic-editor --activate
```

### The ACF PRO licence key

Composer needs your ACF PRO licence key to download the plugin: the key is the username for ACF's repo, and the URL of a site the licence is active for (including `https://`) is the password. Nothing is stored in the project. With `initproject`, pass both as environment variables:

```bash
ACF_PRO_LICENSE=<licence key> ACF_PRO_URL=<licensed site URL> initproject
```

The script passes them to Composer, and adds the key to `wp-config.php` (not committed) so the licence is also activated in WordPress.

By hand, or to update ACF PRO later, pass the same credentials to Composer with `COMPOSER_AUTH`:

```bash
COMPOSER_AUTH='{"http-basic":{"connect.advancedcustomfields.com":{"username":"<licence key>","password":"<licensed site URL>"}}}' composer update
```

To activate the licence in WordPress by hand, add `define( 'ACF_PRO_LICENSE', '<licence key>' );` to `wp-config.php`, or enter it in **ACF → Updates**. Servers use the `wp-config.php` method; see [deploying.md](deploying.md).

## 5. Activate the theme and sync ACF

```bash
ddev wp theme activate <slug>
ddev wp acf json sync
```

This imports the **Components** field group (`acf-json/group_ks_components.json`) into the database. It's the same as **ACF → Field Groups → Sync available**.

The theme doesn't register any custom post types. Add the ones each project needs in **ACF → Post Types**. Their definitions save to `acf-json/` with the field groups. To use the Components field on them, add a location rule to the Components field group. `singular.php` already renders it for any post type.

## 6. Set up content

Content lives in the database, so none of it comes with the theme. `initproject` creates:

- a **Home** page, set as the front page in **Settings → Reading**
- a page using the **Component library** template, to check every component renders
- **Primary** and **Footer** menus, assigned to their locations

Set the site icon yourself in **Settings → General**.

## 7. Make it the project's own

- Replace the design tokens in `src/css/global/variables.css` with the project's (regenerate the type and space scales at [utopia.fyi](https://utopia.fyi)).
- Add the project's fonts to `src/fonts/` (with `@font-face` rules in `src/css/global/fonts.css` and the `--font-*` tokens) and replace the icon sprite at `src/img/icons/sprite.svg`.
- Remove components the project doesn't need. Delete the component, its CSS, its layout file and its layout in the ACF field group, and remove it from `page-templates/components.php`.
