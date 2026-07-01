import { deleteAsync } from 'del';

// Eleventy doesn't clean its output directory between builds, so stale HTML
// from renamed/removed templates would otherwise linger in web/ forever.
// Gulp owns web/assets/ (including web/assets/images/optimized/, written by
// the imageSet/image shortcodes), so that subtree is left untouched here.
await deleteAsync(['web/**', '!web', '!web/assets', '!web/assets/**']);
