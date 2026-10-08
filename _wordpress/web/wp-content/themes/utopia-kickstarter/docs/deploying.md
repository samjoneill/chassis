# Deploying

How to get the site from your machine onto a staging or production server. It works on any host where you can reach the WordPress admin, with no CI needed. If a host offers more (SFTP, SSH, Git deploys), see [Other ways to upload](#other-ways-to-upload).

## Code goes up, content comes down

```
local  ── theme ──▶  staging  ── same theme ──▶  production
local  ◀── database + uploads ───────────────  production   (once live)
```

- **Code** is the theme folder, including the field groups in `acf-json/`. It moves up, from local to staging to production.
- **Content** is pages, menus, settings and uploads. It lives in each site's database and `uploads/` folder. Before launch, you push it up once. After launch, the live site is the master copy: only ever copy it down, to work locally with real content. Pushing a database up after launch overwrites whatever editors have changed since.

## What gets deployed

Only the built theme folder, `web/wp-content/themes/<slug>/`. `src/`, `node_modules` and the gulpfile stay at the project root, so after `npm run build` the theme folder holds exactly what the server needs: PHP, `acf-json/` and the built `assets/`.

`assets/` is gitignored, so always run `npm run build` before deploying, or the theme goes up without its CSS and JS.

## Server requirements

- PHP 8.1+ and WordPress 6.5+. DDEV runs PHP 8.4, so set `php_version` in `.ddev/config.yaml` to match the host and catch anything newer than it supports.
- GD or Imagick with WebP support. The theme saves generated image sizes as WebP.
- **ACF PRO** and **Classic Editor**. Plugins aren't part of the theme, so install them on each server.
- `WP_ENVIRONMENT_TYPE` set in `wp-config.php` (`staging` or `production`). WordPress treats a site without it as `production`.

## First deployment

1. Install WordPress on the server, using the host's installer or by hand.
2. Add the ACF PRO licence key to `wp-config.php`. ACF activates it by itself the next time an admin page loads, and updates then appear under **Plugins** as usual. This is how to activate it on servers, where ACF's licence screen is hidden (see [ACF on servers](#acf-on-servers)):

   ```php
   define( 'ACF_PRO_LICENSE', 'your-licence-key' );
   define( 'WP_ENVIRONMENT_TYPE', 'production' ); // or 'staging'
   ```

3. In **Plugins → Add New → Upload Plugin**, upload the ACF PRO zip (from your ACF account) and activate it. Install **Classic Editor** from the plugin directory.
4. Run `npm run build` locally, zip the theme folder, and upload it in **Appearance → Themes → Add New → Upload Theme**. Activate it.
5. Content: either move your local database and uploads with a migration plugin (WP Migrate, All-in-One WP Migration or Duplicator rewrite the URLs for you), or create the pages and menus on the server.

## Updating the theme

1. `npm run build`
2. Zip the theme folder.
3. Upload it in **Appearance → Themes → Add New → Upload Theme**. Because the folder name matches the active theme, WordPress offers **Replace active with uploaded**.

The upload replaces the whole folder. That's intended: nothing on the server should be edited inside the theme.

After uploading:

- **Field groups** in `acf-json/` take effect straight away. ACF reads them from the theme, and they override any older copy in the database.
- **Browser caches** update by themselves. `inc/assets.php` versions the CSS and JS by file modification time, so new files get new URLs.
- **Page caches** don't. If the host or a caching plugin caches whole pages, clear it.

## ACF on servers

`inc/acf.php` hides ACF's admin (field groups, post types, its settings and licence screens) unless `WP_ENVIRONMENT_TYPE` is `local` or `development`. Field groups are deployed with the theme, so any edit made on a server would differ from git and be overwritten by the next deploy. Make ACF changes locally, then deploy them.

The Components field itself still works for editors everywhere. Only the field group editor is hidden.

To get the ACF admin back on a server temporarily (e.g. to check something), set `WP_ENVIRONMENT_TYPE` to `development` in its `wp-config.php`, and set it back afterwards.

Local sites already count as `local`: `initproject` sets it in `.ddev/config.yaml`, and Local sets it in `wp-config.php`.

## Other ways to upload

All of these deploy the same thing, the built theme folder, so you can switch between them without changing the project.

| Host gives you | How |
| --- | --- |
| Only the WordPress admin | Zip upload, as above |
| SFTP | Upload the built theme folder over the old one. Fine for small changes, but it doesn't remove files you've deleted |
| SSH | `rsync -av --delete web/wp-content/themes/<slug>/ user@host:/path/to/wp-content/themes/<slug>/` mirrors the folder in one command |
| Git deploys or CI (WP Engine, Kinsta, SpinupWP, GitHub Actions…) | The pipeline must run `npm install && npm run build` before deploying, because `assets/` isn't in git |
