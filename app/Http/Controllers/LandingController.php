<?php

namespace App\Http\Controllers;

use MVC\Router;

/**
 * Clase LandingController
 * 
 * Controlador encargado de gestionar la lógica para la página principal (landing page).
 */
class LandingController {
    /**
     * Renderiza la vista principal de la página de aterrizaje.
     *
     * @param Router $router Instancia del enrutador para renderizar vistas.
     * @return void
     */
    public static function index(Router $router) {

        //Render a la vista
        $router->render('index', [
            'titulo' => ''
        ]);
    }
}