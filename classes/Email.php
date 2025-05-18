<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a95a51028d67d6';
        $mail->Password = 'a6cc2c809bc027';

        $mail->setFrom('cuentas@urnal.com');
        $mail->addAddress('cuentas@urnal.com', 'urnal.com');
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';

        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Enhorabuena, estas un paso más cerca de hacer tu vida un pelín más fácil, solo tienes que hacerme un pequeño favor más y te dejo en paz</p>";
        $contenido .= "<p>Confirma tu cuenta de Urnal en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar?token=" .
            $this->token . "'>Confirmar Cuenta</p>";
        $contenido .= "<p>Si este correo no te suena de nada, mejor pasa de largo :)</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }
}
