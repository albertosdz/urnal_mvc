<?php

namespace App\Domain\Models;

/**
 * Class Tarea
 *
 * Representa una tarea dentro de un proyecto, con propiedades para el ID, nombre, estado y el ID del proyecto asociado.
 *
 * @property int|null $id Identificador único de la tarea.
 * @property string $nombre Nombre o descripción de la tarea.
 * @property int $estado Estado actual de la tarea (por ejemplo, 0 para pendiente, 1 para completada).
 * @property string $proyectoId Identificador del proyecto al que pertenece la tarea.
 */
class Tarea extends ActiveRecord {
    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id', 'nombre', 'estado', 'proyectoId'];

    public $id;
    public $nombre;
    public $estado;
    public $proyectoId;

    /**
     * Constructor de la clase Tarea.
     *
     * Inicializa las propiedades de la tarea con los valores proporcionados en el arreglo asociativo.
     *
     * @param array $args Arreglo asociativo con las propiedades para inicializar la tarea:
     *                    - 'id' (int|null): Identificador de la tarea.
     *                    - 'nombre' (string): Nombre o descripción de la tarea.
     *                    - 'estado' (int): Estado de la tarea.
     *                    - 'proyectoId' (string): Identificador del proyecto asociado.
     */
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? 0;
        $this->proyectoId = $args['proyectoId'] ?? '';
    }


}