<?php
/**
 * Archivo de rutas principales de la aplicación.
 *
 * Este archivo define todas las rutas de la aplicación, asociando URLs específicas a
 * métodos concretos de los controladores correspondientes.
 *
 * Utiliza una instancia de Router para registrar rutas de tipo GET y POST,
 * permitiendo así la gestión de la navegación y peticiones de la aplicación.
 *
 * Al final del archivo, se verifica y despachan las rutas registradas,
 * asegurando que cada URL invoque el método adecuado del controlador.
 */

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TareaController;
use MVC\Router;

$router = new Router();

// Landing Page
$router->get('/', [LandingController::class, 'index']);

//------------------------------------------------------------------------------------------

// Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Crear Cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

// Formulario de olvide mi contraseña
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

// Colocar la nueva contraseña
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);
$router->get('/perfil', [LoginController::class, 'perfil']);

//------------------------------------------------------------------------------------------

// PÁGINAS DE TAREAS Y PROYECTOS
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router->post('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router->get('/proyecto', [DashboardController::class, 'proyecto']);
$router->get('/perfil', [DashboardController::class, 'perfil']);
$router->post('/perfil', [DashboardController::class, 'perfil']);
$router->get('/cambiar-password', [DashboardController::class, 'cambiar_contraseña']);
$router->post('/cambiar-password', [DashboardController::class, 'cambiar_contraseña']);

// API para las tareas
$router->get('/api/tareas', [TareaController::class, 'index']);
$router->post('/api/tarea', [TareaController::class, 'crear']);
$router->post('/api/tarea/actualizar', [TareaController::class, 'actualizar']);
$router->post('/api/tarea/eliminar', [TareaController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

