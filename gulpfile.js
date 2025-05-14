import { src, dest, parallel, series, watch } from "gulp";
import postcss from "gulp-postcss";
import postcssGlobImport from "postcss-import-ext-glob";
import postcssImport from "postcss-import";
import autoprefixer from "autoprefixer";
import cssnano from "cssnano";
import sourcemaps from "gulp-sourcemaps";
import concat from "gulp-concat";
import imagemin from "gulp-imagemin";
import { deleteAsync } from "del";
import fs from "fs";
import path from "path";

// Rollup plugins
import { rollup } from "rollup";
import babel from "@rollup/plugin-babel";
import resolve from "@rollup/plugin-node-resolve";
import commonjs from "@rollup/plugin-commonjs";
import terser from "@rollup/plugin-terser";

// File path variables
const paths = {
  styles: {
    src: "src/css/**/*.css",
    dest: "web/assets/css/",
  },
  scripts: {
    src: "src/js/main.js",
    dest: "web/assets/js/",
  },
  vendor: {
    src: "src/js/vendor/**/*.js",
    dest: "web/assets/js/vendor/",
  },
  images: {
    src: "src/img/**/*.{jpg,jpeg,png,svg,gif}",
    dest: "web/assets/img/",
  },
  fonts: {
    src: "src/fonts/**/*",
    dest: "web/assets/fonts/",
  },
};

// Clean output folder
function clean() {
  return deleteAsync(["web/assets"]);
}

// Process CSS
function styles() {
  return src("src/css/global.css")
    .pipe(sourcemaps.init())
    .pipe(
      postcss([postcssGlobImport(), postcssImport(), autoprefixer(), cssnano()])
    )
    .pipe(concat("main.css"))
    .pipe(sourcemaps.write("."))
    .pipe(dest(paths.styles.dest));
}

// Process JavaScript
async function scripts() {
  // Ensure destination directory exists
  if (!fs.existsSync(paths.scripts.dest)) {
    fs.mkdirSync(paths.scripts.dest, { recursive: true });
  }

  // Bundle with Rollup
  const bundle = await rollup({
    input: paths.scripts.src,
    plugins: [
      resolve({ browser: true }),
      commonjs(),
      babel({
        babelHelpers: "bundled",
        presets: ["@babel/preset-env"],
        exclude: "node_modules/**",
      }),
      terser(),
    ],
  });

  // Generate output
  await bundle.write({
    file: path.join(paths.scripts.dest, "bundle.js"),
    format: "iife",
    sourcemap: true,
    name: "bundle",
  });

  // Close the bundle
  await bundle.close();
}

// Process vendor JavaScript
function vendor() {
  return src(paths.vendor.src).pipe(dest(paths.vendor.dest));
}

// Optimize images
function images() {
  return src(paths.images.src).pipe(imagemin()).pipe(dest(paths.images.dest));
}

// Copy fonts
function fonts() {
  return src(paths.fonts.src, { encoding: false }).pipe(dest(paths.fonts.dest));
}

// Define watch task
function watchFiles(cb) {
  watch(paths.styles.src, styles);
  watch(paths.scripts.src, scripts);
  watch(paths.images.src, images);
  watch(paths.fonts.src, fonts);
  cb();
}

// Export tasks
export { clean };
export { styles };
export { scripts };
export { vendor };
export { images };
export { fonts };
export { watchFiles };

// Create default task
export default series(clean, parallel(styles, scripts, vendor, images, fonts));

// Build task
export const build = series(
  clean,
  parallel(styles, scripts, vendor, images, fonts)
);
