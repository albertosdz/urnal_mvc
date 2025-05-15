<?php

namespace Controllers;

use MVC\Router;

class PaginasController {
    public static function index(Router $router) {

        //Render a la vista
        $router->render('index', [
            'titulo' => ''
        ]);
    }
}