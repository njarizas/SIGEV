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




     
    $correo = $_POST["email"] ;
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


         if($mail->Send())
         {
         	$msg = "Lo siento, ha habido un error al enviar el mensaje a $correo";
         }
         else
         {
             $msg= "En hora buena el mensaje ha sido enviado con exito a $correo";
         }

 }
?>
<html>
<head>
<title>Contacto</title>
 <link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/imagenContactenos.css">
</head>
<body>
<h2 style="color: #FFFFFF">Contáctanos</h2>
<strong><?php echo $msg; ?></strong>
<div class="container" >
<div style="background-color: rgba(255,255,266,0.8); padding: 30px; padding-bottom: 10px; border-radius: 10px;margin: 30px; height: 450px; width: 450px;">
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
<label>Nombre del destinatario:</label>   
<input name="nombre" type="text" id="nombre" class="form-control">
<label>Email del destinatario:</label>
<input name="email" type="text" id="email" class="form-control">
<label>Asunto:</label>
<input name="asunto" type="text" id="asunto" class="form-control">
<label>Archivo adjunto:</label>
<input type="file" name="adjunto" class="form-control">
<label>Mensaje:</label>
<textarea name="mensaje" cols="50" rows="4" id="mensaje" class="form-control"></textarea>
<br/>

<button class="btn btn-danger">Enviar</button>
<input type="hidden" name="phpmailer" class="form-control">
</form>
</div>
</div>
</body>
