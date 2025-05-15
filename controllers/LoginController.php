<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            # code...
        }

        //Render a la vista
        $router->render('auth/login', [
            'titulo' => ' | Iniciar Sesión'
        ]);
    }
    public static function logout()
    {
        echo "Desde Logout";
    }
    public static function crear(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            # code...
        }

        //Render a la vista
        $router->render('auth/crear', [
            'titulo' => ' | Crear cuenta'
        ]);
    }
    public static function olvide(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            # code...
        }

        //Render a la vista
        $router->render('auth/olvide', [
            'titulo' => ' | Olvide mi Contraseña'
        ]);
    }
    public static function reestablecer(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            # code...
        }

        //Render a la vista
        $router->render('auth/restablecer', [
            'titulo' => ' | Recuperar Contraseña'
        ]);
    }
    public static function mensaje(Router $router)
    {
        //Render a la vista
        $router->render('auth/mensaje', [
            'titulo' => ' | Cuenta Creada Correctamente'
        ]);
    }
    public static function confirmar(Router $router)
    {
        //Render a la vista
        $router->render('auth/confirmar', [
            'titulo' => ' | Confirme cuenta'
        ]);
    }
}
