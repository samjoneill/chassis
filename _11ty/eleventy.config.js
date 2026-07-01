import { eleventyImageTransformPlugin } from '@11ty/eleventy-img';

let uidCounter = 0;

export default async function (eleventyConfig) {
  eleventyConfig.addNunjucksGlobal('uid', (prefix = 'id') => `${prefix}-${++uidCounter}`);

  // Nunjucks has no built-in date filter (unlike Liquid in 11ty) — formats a
  // Date as e.g. "12 Mar 2026", used for article front-matter dates.
  eleventyConfig.addNunjucksFilter('date', (dateObj) =>
    new Intl.DateTimeFormat('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }).format(new Date(dateObj))
  );

  // Post-processes every rendered <img> tag into an optimised, responsive
  // image — this replaces Craft's imageSet/image Twig macros. It runs on the
  // final HTML output, so it works from inside Nunjucks macros and {% set %}
  // captures (Nunjucks macros can't await a promise directly, which rules out
  // handling this as an async shortcode called from within a macro).
  //
  // Components set `eleventy:widths="400,800"` to request multiple widths,
  // or a plain `width="72"` for a single fixed size (e.g. an avatar); both
  // override these defaults per-image. A single output `format` keeps plain
  // <img> markup instead of wrapping in <picture>.
  eleventyConfig.addPlugin(eleventyImageTransformPlugin, {
    formats: ['webp'],
    widths: [400, 800],
    outputDir: 'web/assets/images/optimized/',
    urlPath: '/assets/images/optimized/',
    htmlOptions: {
      imgAttributes: {
        loading: 'lazy',
        decoding: 'async'
      }
    }
  });

  // Gulp writes CSS/JS straight into the shared web/assets/ dir; reload the
  // browser when that happens without triggering a full Eleventy rebuild.
  eleventyConfig.setServerOptions({
    watch: ['web/assets/**']
  });

  return {
    dir: {
      input: 'content',
      includes: '_includes',
      output: 'web'
    }
  };
}
