<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

$msg = null;

      if (isset($_POST["phpmailer"]))
     {
        
    $nombre = htmlspecialchars($_POST["nombre"]);

    $asunto =htmlspecialchars( $_POST["asunto"]);
    $mensaje = $_POST["mensaje"];
    $adjunto = $_FILES["adjunto"];
    $verificador=false;
        require "../controller/class.phpmailer.php";
        require "../controller/class.smtp.php";
    
          $mail = new PHPMailer;
		  
		  //indico a la clase que use SMTP
          $mail->IsSMTP();
		  
          //permite modo debug para ver mensajes de las cosas que van ocurriendo
          //$mail->SMTPDebug = 2;

		  //Debo de hacer autenticaci�n SMTP
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";

		  //indico el servidor de Gmail para SMTP
          $mail->Host = "smtp.gmail.com";

		  //indico el puerto que usa Gmail
          $mail->Port = 465;

		  //indico un usuario / clave de un usuario de gmail
          $mail->Username = "infosigev@gmail.com";
          $mail->Password = "infosigev8";




         $array = array("eegonzalez03@misena.edu.co");

foreach ($array as $email) {

    $correo     = $email;
    $titulo     = $asunto;
    $contenido  = $mensaje; //campo mensaje del html



    $mail->From = "infosigev@gmail.com";

    $mail->FromName = "Sigev";

    $mail->AddAddress("$correo", "Titulo del boletin");
    $mail->Subject    = "$titulo";

    $mail->IsHTML(true);
    $mail->MsgHTML($contenido);
    if ($adjunto ["size"] > 0)
    {

        $mail->addAttachment($adjunto ["tmp_name"], $adjunto ["name"]);
    }
    $mail->Send();
    $mail->ClearAddresses();

}
         if($mail->Send())
         {
             $msg= "En hora buena el mensaje ha sido enviado con exito a $email";
         }
         else
         {
             $msg = "Lo siento, ha habido un error al enviar el mensaje a $email";
         }

 }
?>
    
<!DOCTYPE HTML>
<html>
<head>
<title>Contacto</title>
</head>
<body>
<h3>Email de Contacto</h3>
<strong><?php echo $msg; ?></strong>

<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
    
<table border="0">
<tr>
<td>Nombre del destinatario:</td>
<td><input name="nombre" type="text" id="nombre"></td>
</tr>
<tr>
<td>Email del destinatario:</td>
<td><input name="email" type="text" id="email"></td>
</tr>
<tr>
<td>Asunto:</td>
<td><input name="asunto" type="text" id="asunto"></td>
</tr>
<tr>
<td>Archivo adjunto:</td>
<td><input type="file" name="adjunto"></td>
</tr>
<tr>
<td>Mensaje:</td>
<td><textarea name="mensaje" cols="50" rows="15" id="mensaje"></textarea></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Enviar"></td>
</tr>
</table>
<input type="hidden" name="phpmailer">
</form>
</body>