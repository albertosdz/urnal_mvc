<?php

/**
 * Imprime una representación legible de una variable y detiene la ejecución del script.
 *
 * @param mixed $variable La variable que se desea depurar.
 * @return string No retorna, detiene la ejecución después de imprimir.
 */
function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

/**
 * Escapa caracteres especiales en una cadena para evitar vulnerabilidades XSS.
 *
 * @param string $html La cadena HTML que se desea sanitizar.
 * @return string La cadena escapada y segura para mostrar en HTML.
 */
function s($html) : string {
    return htmlspecialchars($html);
}

/**
 * Helper para acceder a la configuración de la aplicación
 * 
 * @param string $key Clave de configuración
 * @param mixed $default Valor por defecto
 * @return mixed
 */
function config($key, $default = null) {
    return \App\Helpers\Config::get($key, $default);
}

/**
 * Helper para acceder a variables de entorno
 * 
 * @param string $key Nombre de la variable de entorno
 * @param mixed $default Valor por defecto
 * @return mixed
 */
function env($key, $default = null) {
    return $_ENV[$key] ?? $default;
}

/**
 * Verifica si el usuario está autenticado; si no, redirige a la página principal.
 *
 * No recibe parámetros ni retorna valores.
 * 
 * @return void
 */
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}
