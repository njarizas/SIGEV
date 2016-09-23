<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>SIGEV</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/imagen.css">
        <link rel="stylesheet" href="css/formValidation.min.css"> <!-- NEW!!! -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formValidation.min.js"></script> <!-- NEW!!! -->
        <script src="js/bootstrap.js"></script> <!-- NEW!!! -->
        <script src="js/es_ES.js"></script>
        <script src="js/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
    </head>
    <body>
        <?php
        require_once '../model/dto/Usuario.class.php';
        require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
        $usuarioDAO = new UsuariosMySqlDAO();
        $user = "";
        $password = "";
        if (isset($_REQUEST['iniciar-sesion'])) {
            $user = ($_POST["usuario"]);
            $password = ($_POST["contrasena"]);
            $usuExiste = $usuarioDAO->obtenerUsuarioPorDocumento($user);
            $usuExiste2 = $usuarioDAO->obtenerUsuarioPorCorreo($user);
            session_start();
            if ($usuExiste->rowCount() == 1) {
                foreach ($usuExiste as $fila) {
                    $u = $fila;
                }
                if (strcmp($u['clave'], md5(sha1($password))) == 0) {
                    $_SESSION['usuario'] = $u;
//                            echo "<script>swal(\"Bienvenido\",\"Hola " . $u['nombres'] . " haz iniciado sesión satisfactoriamente \", \"success\");</script>";
                    echo "<script>window.location='index.php';</script>";
                } else {
                    echo "<script>swal(\"Contraseña incorrecta\",\"La contraseña de acceso suministrada no es correcta \", \"error\");</script>";
                }
            } else if ($usuExiste2->rowCount() == 1) {
                foreach ($usuExiste2 as $fila) {
                    $u = $fila;
                }
                if (strcmp($u['clave'], md5(sha1($password))) == 0) {
                    $_SESSION['usuario'] = $u;
//                            echo "<script>swal(\"Bienvenido\",\"Hola " . $u['nombres'] . " haz iniciado sesión satisfactoriamente \", \"success\");</script>";
                    echo "<script>window.location='index.php';</script>";
                } else {
                    echo "<script>swal(\"Contraseña incorrecta\",\"La contraseña de acceso suministrada no es correcta \", \"error\");</script>";
                }
            } else {
                echo "<script>swal(\"Usuario incorrecto\",\"No existe ningún usuario con número de documento o correo electrónico igual al ingresado \", \"warning\");</script>";
            }
        }
        ?>

        <div>
            <h2 style="color: #FFFFFF">Sistema de información para la gestión de exámenes virtuales</h2>
        </div>

        <noscript>
        <p class="text-danger">
            Debe habilitar el JavaScript en su navegador!!!
        </p>
        </noscript>
        <form id="form_iniciar_sesion" method="post" class="form-horizontal" action="iniciar-sesion.php">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-4
                 col-md-offset-1">
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="form-group">
                    <label class=" control-label" for="usuario" style="color: #FFFFFF">Usuario:</label>
                    <div class="validacion">
                        <input type="text" class="form-control" id="usuario" name="usuario" maxlength="100"
                               placeholder="Documento o Correo electrónico" value="<?= $user; ?>" required>
                    </div>
                </div>

                <div class=" form-group">
                    <label class=" control-label" for="contrasena"style="color: #FFFFFF" >Contraseña:</label>
                    <div class=" validacion">
                        <input type="password" class="form-control" id="contrasena"
                               name="contrasena" placeholder="Contraseña" required
                               value="<?= $password; ?>">
                    </div>
                </div>

                <div class=" form-group">

                    <button type="submit" class="btn btn-primary" name="iniciar-sesion"
                            value="iniciar-sesion">Iniciar sesión
                    </button>
 
                </div>
  
            </div>
 
        </form> 
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                             <?php
include ("footer.php");
?>
        <script type = "text/javascript">
            $().ready(function () {
                $('#form_iniciar_sesion').formValidation({
                    message: 'Este valor no es correcto',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        usuario: {
                            row: '.validacion',
                            validators: {
                                notEmpty: {
                                    message: 'El usuario es obligatorio'
                                },
                                stringLength: {
                                    min: 4,
                                    message: 'El número de documento debe tener mínimo 4 caracteres'
                                },
                                regexp: {
                                    regexp: /^[0-9]*([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4}))?$/,
                                    message: 'El número de documento o correo electrónico no tiene un formato válido'
                                }
                            }
                        },
                        contrasena: {
                            row: '.validacion',
                            validators: {
                                notEmpty: {
                                    message: 'La contraseña es obligatoria'
                                },
                                stringLength: {
                                    min: 6,
                                    message: 'La contraseña debe contener mínimo 6 caracteres'
                                }
                            }
                        }
                    }
                });
            });
        </script>

    </div>

</div>



