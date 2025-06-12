/**
 * Archivo de configuración de Gulp para automatizar tareas:
 * - Compila archivos SCSS en CSS comprimido con sourcemaps.
 * - Minifica archivos JavaScript.
 * - Observa archivos SCSS y JS para ejecutar nuevamente las tareas correspondientes durante el desarrollo.
 */

import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'

const sass = gulpSass(dartSass)

const paths = {
    scss: 'resources/scss/**/*.scss',
    js: 'public/js/**/*.js'
}

/**
 * Compila archivos SCSS a CSS comprimido con sourcemaps.
 * El CSS resultante se guarda en './public/build/css'.
 */
export function css( done ) {
    src(paths.scss, {sourcemaps: true})
        .pipe( sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError) )
        .pipe( dest('./public/build/css', {sourcemaps: '.'}) );
    done()
}

/**
 * Minifica archivos JavaScript.
 * Los archivos resultantes se guardan en './public/build/js'.
 */
export function js( done ) {
    src(paths.js)
      .pipe(terser())
      .pipe(dest('./public/build/js'))
    done()
}

/**
 * Observa archivos SCSS y JS para detectar cambios.
 * Al cambiar, ejecuta la tarea correspondiente de css o js.
 */
export function dev() {
    watch( paths.scss, css );
    watch( paths.js, js );
}

export default series( js, css, dev )