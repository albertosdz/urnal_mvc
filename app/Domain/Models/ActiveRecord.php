<?php

namespace App\Domain\Models;

/**
 * Clase base para modelos que siguen el patrón Active Record.
 * Proporciona métodos para interactuar con la base de datos mediante operaciones CRUD.
 */
class ActiveRecord
{

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];

    /**
     * Establece la conexión a la base de datos.
     *
     * @param mysqli $database Instancia de conexión mysqli.
     */
    public static function setDB($database)
    {
        self::$db = $database;
    }

    /**
     * Agrega un mensaje de alerta de un tipo específico.
     *
     * @param string $tipo Tipo de alerta.
     * @param string $mensaje Mensaje de alerta.
     */
    public static function setAlerta($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    /**
     * Obtiene todas las alertas almacenadas.
     *
     * @return array Arreglo de alertas.
     */
    public static function getAlertas()
    {
        return static::$alertas;
    }

    /**
     * Valida el objeto actual.
     *
     * @return array Arreglo de alertas después de la validación.
     */
    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    /**
     * Guarda el registro actual en la base de datos.
     * Decide si se debe crear un nuevo registro o actualizar uno existente.
     *
     * @return mixed Resultado de la operación de guardado.
     */
    public function guardar()
    {
        $resultado = '';
        if (!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    /**
     * Obtiene todos los registros de la tabla.
     *
     * @return array Arreglo de objetos con todos los registros.
     */
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Busca un registro por su ID.
     *
     * @param int $id Identificador del registro.
     * @return mixed Objeto del registro encontrado o null si no existe.
     */
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    /**
     * Obtiene un número limitado de registros.
     *
     * @param int $limite Número máximo de registros a obtener.
     * @return mixed Objeto del registro o null si no existe.
     */
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    /**
     * Busca un registro que coincida con una columna y valor específicos.
     *
     * @param string $columna Nombre de la columna.
     * @param mixed $valor Valor a buscar.
     * @return mixed Objeto del registro encontrado o null si no existe.
     */
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    /**
     * Obtiene todos los registros que pertenecen a un valor específico en una columna.
     *
     * @param string $columna Nombre de la columna.
     * @param mixed $valor Valor a buscar.
     * @return array Arreglo de objetos que coinciden con la condición.
     */
    public static function belongsTo($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Ejecuta una consulta SQL personalizada.
     *
     * @param string $consulta Consulta SQL a ejecutar.
     * @return array Arreglo de objetos resultantes de la consulta.
     */
    public static function SQL($consulta)
    {
        $query = $consulta;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    /**
     * Crea un nuevo registro en la base de datos con los atributos del objeto.
     *
     * @return array Resultado de la operación y el ID insertado.
     */
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);

        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
        ];
    }

    /**
     * Actualiza un registro existente en la base de datos con los atributos del objeto.
     *
     * @return bool Resultado de la operación de actualización.
     */
    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        // debuguear($query);

        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
     * Elimina el registro actual de la base de datos.
     *
     * @return bool Resultado de la operación de eliminación.
     */
    public function eliminar()
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    /**
     * Ejecuta una consulta SQL y devuelve un arreglo de objetos.
     *
     * @param string $query Consulta SQL a ejecutar.
     * @return array Arreglo de objetos resultantes.
     */
    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    /**
     * Crea una instancia del objeto con los datos proporcionados.
     *
     * @param array $registro Arreglo asociativo con los datos del registro.
     * @return static Instancia del objeto creado.
     */
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }



    /**
     * Obtiene un arreglo con los atributos del objeto que corresponden a las columnas de la base de datos.
     *
     * @return array Arreglo asociativo de atributos y valores.
     */
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    /**
     * Sanitiza los atributos para evitar inyección SQL.
     *
     * @return array Arreglo asociativo de atributos sanitizados.
     */
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string((string) $value);
        }
        return $sanitizado;
    }

    /**
     * Sincroniza los atributos del objeto con un arreglo de datos proporcionado.
     *
     * @param array $args Arreglo asociativo con datos para sincronizar.
     */
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
