<?php

/**
 * Controlador para manejar las operaciones relacionadas con las tareas.
 * Proporciona métodos para listar, crear, actualizar y eliminar tareas
 * asociadas a proyectos específicos.
 */

namespace App\Http\Controllers;

use App\Domain\Models\Proyecto;
use App\Domain\Models\Tarea;

/**
 * Clase TareaController
 *
 * Responsable de gestionar las operaciones CRUD de las tareas dentro de un proyecto.
 */
class TareaController
{
    /**
     * Obtiene y devuelve en formato JSON todas las tareas asociadas a un proyecto.
     *
     * @return void Imprime un JSON con las tareas o redirige en caso de error.
     */
    public static function index()
    {

        $proyectoId = $_GET['id'];

        if (!$proyectoId) header('Location: /dashboard');

        $proyecto = Proyecto::where('url', $proyectoId);

        session_start();

        if (!$proyecto || $proyecto->usuarioId !== $_SESSION['id']) header('Location: /404');

        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);

        echo json_encode(['tareas' => $tareas]);
    }
    /**
     * Crea una nueva tarea asociada a un proyecto después de validar permisos.
     *
     * @return void Imprime un JSON con el resultado de la operación.
     */
    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $proyectoId = $_POST['proyectoId'];

            $proyecto = Proyecto::where('url', $proyectoId);

            if (!$proyecto || $proyecto->usuarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'hubo un Error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            // No hay errores, instanciamos y creamos la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea Creada Correctamente',
                'proyectoId' => $proyecto->id
            ];
            echo json_encode($respuesta);
        }
    }
    /**
     * Actualiza una tarea existente después de validar permisos.
     *
     * @return void Imprime un JSON con el resultado de la operación.
     */
    public static function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validamos que el proyecto exista
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            session_start();

            if (!$proyecto || $proyecto->usuarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'hubo un Error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;

            $resultado = $tarea->guardar();
            if ($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'proyectoId' => $proyecto->id,
                    'mensaje' => 'Actualizado correctamente'
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }
        }
    }
    /**
     * Elimina una tarea después de validar permisos.
     *
     * @return void Imprime un JSON con el resultado de la operación.
     */
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validamos que el proyecto exista
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            session_start();

            if (!$proyecto || $proyecto->usuarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'hubo un Error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Eliminado correctamente',
                'tipo' => 'exito'
            ];

            echo json_encode($resultado);
        }
    }
}
