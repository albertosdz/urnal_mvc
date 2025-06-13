<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use App\Helpers\Config;

/**
 * Clase para manejar el envío de correos electrónicos relacionados con la cuenta de usuario,
 * como confirmación de cuenta y recuperación de contraseña.
 */
class Email
{
    protected $email;
    protected $nombre;
    protected $token;

    /**
     * Constructor de la clase Email.
     *
     * @param string $email  Dirección de correo electrónico del destinatario.
     * @param string $nombre Nombre del destinatario.
     * @param string $token  Token único para la confirmación o recuperación.
     */
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    /**
     * Envía un correo electrónico para la confirmación de la cuenta del usuario.
     *
     * @return void
     */
    public function enviarConfirmacion()
    {
        // Configurar PHPMailer con variables de entorno
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
        $mail->SMTPAuth = true;
        $mail->Port = env('MAIL_PORT', 587);
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = 'tls';

        $mail->setFrom(env('MAIL_USERNAME'), env('APP_NAME', 'Urnal'));
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';

        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Enhorabuena, estas un paso más cerca de hacer tu vida un pelín más fácil, solo tienes que hacerme un pequeño favor más y te dejo en paz</p>";
        $contenido .= "<p>Confirma tu cuenta de Urnal en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . env('APP_URL', 'http://localhost:3000') . "/confirmar?token=" .
            $this->token . "'>Confirmar Cuenta</p>";
        $contenido .= "<p>Si este correo no te suena de nada, mejor pasa de largo :)</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }

    /**
     * Envía un correo electrónico con instrucciones para recuperar la contraseña.
     *
     * @return void
     */
    public function enviarInstrucciones()
    {
        // Configurar PHPMailer con variables de entorno
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
        $mail->SMTPAuth = true;
        $mail->Port = env('MAIL_PORT', 587);
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = 'tls';

        $mail->setFrom(env('MAIL_USERNAME'), env('APP_NAME', 'Urnal'));
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Recuperación de contraseña';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';

        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Es normal, a todo el mundo le cuestra acordarse de la contraseña</p>";
        $contenido .= "<p>Recupera tu contraseña de Urnal en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . env('APP_URL', 'http://localhost:3000') . "/reestablecer?token=" .
            $this->token . "'>Recuperar Contraseña</p>";
        $contenido .= "<p>Si este correo no te suena de nada, mejor pasa de largo :)</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }
}
