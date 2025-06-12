<?php

namespace App\Domain\Models;

/**
 * Clase Usuario
 *
 * Modelo que representa a los usuarios del sistema.
 * Proporciona métodos para la gestión de usuarios, validación de datos,
 * autenticación y utilidades relacionadas con la seguridad.
 *
 * @package App\Domain\Models
 */
class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $contraseña_actual;
    public $contraseña_nueva;
    public $token;
    public $confirmado;

    /**
     * Constructor de la clase Usuario.
     *
     * Inicializa las propiedades del usuario usando los valores proporcionados en el array asociativo.
     *
     * @param array $args Array asociativo con los valores para inicializar el usuario.
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->contraseña_actual = $args['contraseña_actual'] ?? '';
        $this->contraseña_nueva = $args['contraseña_nueva'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    /**
     * Valida los datos necesarios para el inicio de sesión del usuario.
     *
     * @return array Alertas generadas durante la validación.
     */
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La Contraseña del Usuario es Obligatoria';
        }

        return self::$alertas;
    }

    /**
     * Valida los datos necesarios para crear una nueva cuenta de usuario.
     *
     * @return array Alertas generadas durante la validación.
     */
    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La Contraseña del Usuario es Obligatoria';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    /**
     * Valida el email del usuario.
     *
     * @return array Alertas generadas durante la validación.
     */
    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
    }

    /**
     * Valida la contraseña del usuario.
     *
     * @return array Alertas generadas durante la validación.
     */
    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'La Contraseña del Usuario es Obligatoria';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    /**
     * Valida los datos del perfil del usuario.
     *
     * @return array Alertas generadas durante la validación.
     */
    public function validar_perfil()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        return self::$alertas;
    }

    /**
     * Valida el cambio de contraseña del usuario.
     *
     * @return array Alertas generadas durante la validación.
     */
    public function nueva_contraseña()
    {
        if (!$this->contraseña_actual) {
            self::$alertas['error'][] = 'La contraseña actual no puede estar vacía';
        }
        if (!$this->contraseña_nueva) {
            self::$alertas['error'][] = 'La nueva contraseña no puede estar vacía';
        }
        if (strlen($this->contraseña_nueva) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    /**
     * Comprueba si la contraseña actual introducida es correcta.
     *
     * @return bool True si la contraseña es correcta, false en caso contrario.
     */
    public function comprobar_contraseña(): bool
    {
        return password_verify($this->contraseña_actual, $this->password);
    }

    /**
     * Hashea la contraseña del usuario utilizando BCRYPT.
     *
     * @return void
     */
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * Genera un token único para el usuario.
     *
     * @return void
     */
    public function crearToken(): void
    {
        $this->token = uniqid();
    }
}
