<?php

include_once (dirname(dirname(__FILE__)) . './../controlador/PHPMailer/class.phpmailer.php');
//include_once (dirname(dirname(__FILE__)) . '/DAL/Conexion/Conexion.php');

class Correo {

    function __construct($correoDestino, $nombrePersona, $codigo) {
        try {
            $mail = new PHPMailer(true); //Creacion de la instancia con excepciones habilitadas

            $mail->IsSMTP();                           // Decir a la clase que use SMTP
            $mail->SMTPAuth = true;                  // Activar autenticacion SMTP
			//$mail->SMTPSecure = 'tls';
            $mail->Port = 465;                    // Establecer el puerto del servidor SMTP
            $mail->Host = "smtp.gmail.com"; // servidor SMTP
            $mail->Username = "isqm.system@gmail.com"; // Nombre de usuario del servidor SMTP
            $mail->Password = "12345isqm";            // Password del servidor SMTP

            //$mail->IsSendmail();  // Decir a la clase q use SendMail, solo si lo necesita.
            //$mail->AddReplyTo("mail.dominio.com", "Nombre");

            $mail->From = "isqm.system@gmail.com";
            $mail->FromName = "Sigev";

            $mail->AddAddress($correoDestino);

            $mail->Subject = "Prueba de correo";

            //$mail->AltBody = "Señor(a) "; // opcional, comment out and test
            $mail->WordWrap = 255; // Establecer maximo de caracteres

            $body = "<html>
                <head>
                <title>Correo de Informacion</title>
                </head>
                <body>
               </body>
			   Esto es una prueba de envío de correo n PHP señor ".$nombrePersona." su correo es : ". $correoDestino." 
                </html>";
            $mail->MsgHTML($body);

            $mail->IsHTML(true); // enviar como HTML
		echo 'si buenas';	
            if (!$mail->Send()) {
                echo 'El mensaje no fue enviado.';
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                
                echo 'Message has been sent.';
            }
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        }
    }


}

?>