<?php

namespace App\Helpers;

/**
 * Clase helper para acceder a la configuración de la aplicación.
 */
class Config
{
    private static $config = null;

    /**
     * Carga y devuelve la configuración de la aplicación.
     *
     * @return array
     */
    public static function getConfig()
    {
        if (self::$config === null) {
            self::$config = require __DIR__ . '/../../config/app.php';
        }
        return self::$config;
    }

    /**
     * Obtiene un valor de configuración por clave.
     *
     * @param string $key Clave de configuración (soporta notación de puntos)
     * @param mixed $default Valor por defecto si no se encuentra la clave
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $config = self::getConfig();
        $keys = explode('.', $key);
        
        foreach ($keys as $segment) {
            if (is_array($config) && array_key_exists($segment, $config)) {
                $config = $config[$segment];
            } else {
                return $default;
            }
        }
        
        return $config;
    }

    /**
     * Obtiene una variable de entorno.
     *
     * @param string $key Nombre de la variable de entorno
     * @param mixed $default Valor por defecto
     * @return mixed
     */
    public static function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

