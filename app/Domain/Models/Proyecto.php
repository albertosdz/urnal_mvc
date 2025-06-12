<?php

namespace App\Domain\Models;

use App\Domain\Models\ActiveRecord;

/**
 * Clase Proyecto
 *
 * Representa un proyecto dentro del sistema, con sus atributos principales
 * como nombre, URL y el ID del usuario propietario.
 *
 * Extiende de ActiveRecord para proporcionar funcionalidad ORM.
 */
class Proyecto extends ActiveRecord
{
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'proyecto', 'url', 'usuarioId'];

    public $id;
    public $proyecto;
    public $url;
    public $usuarioId;

    /**
     * Constructor de la clase Proyecto.
     *
     * Inicializa las propiedades del proyecto a partir de un array asociativo.
     *
     * @param array $args Array asociativo con las claves 'id', 'proyecto', 'url' y 'usuarioId'.
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
    }

    /**
     * Valida los datos del proyecto actual.
     *
     * Verifica que el nombre del proyecto esté presente y no exceda los 20 caracteres.
     * Agrega mensajes de alerta en caso de errores de validación.
     *
     * @return array Arreglo de alertas generadas durante la validación.
     */
    public function validarProyecto()
    {
        if (!$this->proyecto) {
            self::$alertas['error'][] = 'El nombre del Proyecto es obligatorio';
        }

        if (strlen($this->proyecto) > 20) {
            self::$alertas['error'][] = 'El nombre del Proyecto no puede tener más de 20 caracteres';
        }
        return self::$alertas;
    }
}
