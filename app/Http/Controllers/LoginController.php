<?php

/**
 * Controlador para gestionar la autenticación y administración de usuarios.
 * Maneja el inicio de sesión, cierre de sesión, creación de cuenta, recuperación y restablecimiento de contraseña,
 * así como la confirmación de cuentas mediante tokens.
 */

namespace App\Http\Controllers;

use App\Services\Email;
use App\Domain\Models\Usuario;
use MVC\Router;

/**
 * Clase LoginController
 * 
 * Controlador responsable de las operaciones relacionadas con el login y la gestión de usuarios.
 */
class LoginController
{
    /**
     * Muestra el formulario de inicio de sesión y procesa el login de usuarios.
     *
     * @param Router $router Router para renderizar vistas.
     * @return void
     */
    public static function login(Router $router)
    {
        $alertas=[];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                // Verificar que el usuario exista
                $usuario = Usuario::where('email', $usuario->email);

                if (!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El usuario existe
                    if (password_verify($_POST['password'], $usuario->password)) {
                        // Iniciamos la sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamos
                        header('Location: /dashboard');

                    } else {
                    Usuario::setAlerta('error', 'Contraseña incorrecta');

                    }

                }
            }
        }

        $alertas = Usuario::getAlertas();

        //Render a la vista
        $router->render('auth/login', [
            'titulo' => ' | Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }
    /**
     * Cierra la sesión del usuario y redirige al inicio.
     *
     * @return void
     */
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    /**
     * Muestra el formulario de creación de cuenta y procesa el registro de nuevos usuarios.
     *
     * @param Router $router Router para renderizar vistas.
     * @return void
     */
    public static function crear(Router $router)
    {
        $alertas = [];
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2 ya que no es necesario guardarlo en la base de datos
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado = $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        //Render a la vista
        $router->render('auth/crear', [
            'titulo' => ' | Crear cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    /**
     * Muestra el formulario para solicitar recuperación de contraseña y envía instrucciones por email.
     *
     * @param Router $router Router para renderizar vistas.
     * @return void
     */
    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                //Buscamos al usuario
                $usuario = Usuario::where('email', $usuario->email);

                if ($usuario && $usuario->confirmado) {

                    //Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email,$usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // Imprimir la alerta
                    Usuario::setAlerta('exito', 'Revise su email para cambiar la contraseña');
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();


        //Render a la vista
        $router->render('auth/olvide', [
            'titulo' => ' | Olvide mi Contraseña',
            'alertas' => $alertas
        ]);
    }
    /**
     * Permite restablecer la contraseña utilizando un token válido.
     *
     * @param Router $router Router para renderizar vistas.
     * @return void
     */
    public static function reestablecer(Router $router)
    {
        $token = s($_GET['token']);
        $mostrarInput = true;

        if(!$token) header('Location: /');

        //Identificamos al usuario con el token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido');
            $mostrarInput = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //Añadir la nueva contraseña
            $usuario->sincronizar($_POST);

            // Validar Contraseña
            $usuario->validarPassword();

            if (empty($alertas)) {
                // Hashear la nueva contraseña
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Actualizar usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /login');
                }

                
            }
        }

        $alertas = Usuario::getAlertas();

        //Render a la vista
        $router->render('auth/reestablecer', [
            'titulo' => ' | Recuperar Contraseña',
            'alertas' => $alertas,
            'mostrarInput' => $mostrarInput
        ]);
    }
    /**
     * Muestra un mensaje informativo tras la creación de una cuenta.
     *
     * @param Router $router Router para renderizar vistas.
     * @return void
     */
    public static function mensaje(Router $router)
    {
        //Render a la vista
        $router->render('auth/mensaje', [
            'titulo' => ' | Cuenta Creada Correctamente'
        ]);
    }
    /**
     * Confirma la cuenta de usuario mediante un token enviado por email.
     *
     * @param Router $router Router para renderizar vistas.
     * @return void
     */
    public static function confirmar(Router $router)
    {
        $token = s($_GET['token']);

        if (!$token) header('Location: /');

        //Encontrar al usuario con esre token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            //No se encuentra usuario con el token
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Confirmar cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);

            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Validada');
        }

        $alertas = Usuario::getAlertas();

        //Render a la vista
        $router->render('auth/confirmar', [
            'titulo' => ' | Confirme cuenta',
            'alertas' => $alertas ?? null
        ]);
    }
}
