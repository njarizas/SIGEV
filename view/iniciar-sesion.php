<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>SIGEV</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/formValidation.min.css"> <!-- NEW!!! -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formValidation.min.js"></script> <!-- NEW!!! -->
        <script src="js/bootstrap.js"></script> <!-- NEW!!! -->
        <script src="js/es_ES.js"></script> <!-- NEW!!! -->
        <!-- This is what you need -->
        <script src="js/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
        <!--.......................-->
    </head>
    <body>
        <div class="container" style="background-color:#EEE;">
            <div class="col-sm-8 col-sm-offset-2" style="background-color:#FFF;">
                <header> 
                    <img class="img-responsive pull-left" src="img/SIGEV.png" height="100" width="100">
                    <h2>SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE EXAMENES VIRTUALES.</h2><hr>
                </header>
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
                <div class="page-header">
                    <h2>Iniciar Sesión</h2>
                </div>
                <noscript>
                <p class="text-danger">
                    Debe habilitar el JavaScript en su navegador!!!
                </p>
                </noscript>
                <form id="form_iniciar_sesion" method="post" class="form-horizontal" action="iniciar-sesion.php">
                    <div class="form-group">
                        <label class="col-xs-3 col-sm-3 col-sm-offset-1 control-label" for="usuario">Usuario:</label>
                        <div class="col-xs-9 col-sm-7 col-md-5 validacion">
                            <input type="text" class="form-control" id="usuario" name="usuario" maxlength="100"
                                   placeholder="Número de documento o Correo electrónico" value="<?= $user; ?>" required>
                        </div>
                    </div>
                    <div class=" form-group">
                        <label class="col-xs-3 col-sm-3 col-sm-offset-1 control-label" for="contrasena">Contraseña:</label>
                        <div class="col-xs-9 col-sm-7 col-md-5 validacion">
                            <input type="password" class="form-control" id="contrasena"
                                   name="contrasena" placeholder="" required
                                   value="<?= $password; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary  col-xs-4 col-xs-offset-4" name="iniciar-sesion"
                            value="iniciar-sesion">Iniciar Sesion
                    </button>
                </form>                  
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
                <br>
                <?php
                include ("footer.php");
                ?>