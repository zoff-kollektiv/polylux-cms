import autoprefixer from 'autoprefixer';
import commonjs from 'rollup-plugin-commonjs';
import copy from 'rollup-plugin-cpy';
import postcss from 'rollup-plugin-postcss';
import postcssCustomProperties from 'postcss-custom-properties';
import postcssImport from 'postcss-import';
import postcssNested from 'postcss-nested';
import postcssImportExtGlob from 'postcss-import-ext-glob';
import resolve from 'rollup-plugin-node-resolve';
import { terser } from 'rollup-plugin-terser';

const { env } = process;
const isProduction = env.NODE_ENV === 'production';

const CONFIG = {
  plugins: [
    copy({
      files: [
        './static/fonts/**/*'
      ],
      dest: './dist/fonts/',
      options: {
        verbose: true
      }
    }),

    postcss({
      extract: true,
      minimize: isProduction,
      plugins: [
        postcssImportExtGlob(),
        postcssImport(),
        postcssCustomProperties({
          preserve: false
        }),
        postcssNested(),
        autoprefixer()
      ]
    }),

    resolve(),
    commonjs()
  ],

  input: './static/index.js',

  output: {
    file: './dist/index.js',
    format: 'iife',
    sourcemap: isProduction ? false : 'inline'
  }
};

if (isProduction) {
  CONFIG.plugins.push(terser());
}

export default CONFIG;
