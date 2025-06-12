<?php

namespace App\Http\Controllers;

use App\Domain\Models\Proyecto;
use App\Domain\Models\Usuario;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $id = $_SESSION['id'];

        $proyectos = Proyecto::belongsTo('usuarioId', $id);


        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public static function crear_proyecto(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            // validación
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                // Generar una URL única para el proyecto
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                // Almacenar usuario correspondiente al proyecto
                $proyecto->usuarioId = (int) $_SESSION['id'];

                // Guardar el proyecto
                $resultado = $proyecto->guardar();

                // Redireccionar
                if ($resultado) {
                    header('Location: /proyecto?id=' . $proyecto->url);
                }
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router)
    {

        session_start();
        isAuth();
        $alertas = [];

        $token = $_GET['id'];
        if (!$token) header('Location: /dashboard');
        // Aseguramos los proyectos para que sean privados
        $proyecto = Proyecto::where('url', $token);
        if ($proyecto->usuarioId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }

        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar_perfil();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    // Alerta mensaje error
                    Usuario::setAlerta('error', 'Email no válido, ya pertenece a otra cuenta');
                    $alertas = $usuario->getAlertas();
                } else {
                    // Guardar nuevos datos
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Guardado Correctamente');
                    $alertas = $usuario->getAlertas();

                    //Asignamos nuevos datos a la sesión
                    $_SESSION['nombre'] = $usuario->nombre;
                }
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiar_contraseña(Router $router)
    {
        session_start();
        isAuth();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);

            // Sincronizar con los datos de usuario
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nueva_contraseña();

            if (empty($alertas)) {
                $resultado = $usuario->comprobar_contraseña();

                if ($resultado) {

                    $usuario->password = $usuario->contraseña_nueva;

                    unset($usuario->contraseña_actual);
                    unset($usuario->contraseña_nueva);

                    // Hashear nueva contraseña
                    $usuario->hashPassword();

                    // Actualizamos
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Contraseña Actuzalizada correctamente');
                        $alertas = $usuario->getAlertas();
                    }

                } else {
                    Usuario::setAlerta('error', 'Contraseña Incorrecta');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('dashboard/cambiar-contraseña', [
            'titulo' => 'Cambiar Contraseña',
            'alertas' => $alertas
        ]);
    }
}
