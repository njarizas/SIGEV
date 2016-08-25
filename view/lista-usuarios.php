<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lista Usuario</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/formValidation.min.css"> <!-- NEW!!! -->
        <link rel="stylesheet" type="text/css" href="css/estilosSigev.css">
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formValidation.min.js"></script> <!-- NEW!!! -->
        <script src="js/bootstrap.js"></script> <!-- NEW!!! -->
        <script src="js/es_ES.js"></script> <!-- NEW!!! -->
        <script src="js/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
    </head>
    <body>   
        <form id="editarusuario" method="get" class="form-horizontal" action="lista-usuarios.php">
        <div class="container" style="background-color:#EEE;">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2" style="background-color:#FFF;">
                    <?php
                    include("header.php");
                    require_once '../model/dto/Usuario.class.php';
                    require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
                    require_once '../model/dao/implementacion/TiposdocumentosMySqlDAO.class.php';
                    $usuarioDAO = new UsuariosMySqlDAO();
                    ?>
                    <div class="page-header">
                        <h2>Lista de usuarios</h2>
                    </div>
                    <noscript>
                    <p class="text-danger">
                        Debe habilitar el JavaScript en su navegador!!!
                    </p>
                    </noscript>
                    <?php
                    $usuarioslis = $usuarioDAO->listarUsuarios();
                    if (count($usuarioslis) > 0) {
                        echo '<div class="row"><div class="col-xs-12 col-sm-10 col-sm-offset-1">'
                        . '<table border="1" class="table table-hover">'
                        . '<tr><td>Documento</td><td>Nombres</td><td>Apellidos</td><td>Correo</td>'
                        . '<td>Acción a realizar</td></tr>';
                    }

                    foreach ($usuarioslis as $fila) {
                        echo '<tr>'
                        . '<td>' . $fila['documento'] . '</td>';
                      echo'<td>' . $fila['nombres'] . '</td>';
                      echo'<td>' . trim($fila['apellido1']) . ' ' . $fila['apellido2'] . '</td>';
                      echo'<td>' . $fila['correo'] . '</td>';
                      echo'<td> <button type="submit" class="btn btn-primary" name="editar-usuario"
                                        value="'. $fila['documento'] .'">Editar
                                      
                                </button> </td></tr>';
                                            
                    }
                    echo '</table></div></div>';
                                       
                     $usuarioDAO = new UsuariosMySqlDAO;

                    if (isset($_POST['editar-usuario'])) {
                        
                        $documento = ($_POST["editar-usuario"]);
                        echo $documento;
                        echo '<script>alert("hola")</script>';
                        $usuario = $usuarioDAO->obtenerUsuarioPorDocumento($documento);
                        $documento = $usuario->getDocumento();
//                        $documento = ($_POST["documento"]);
//                        $nombres($_POST["nombres"]);
//                        $apellido1 = ($_POST["apellido1"]);
//                        $apellido2 = ($_POST["apellido2"]);
//                        $correo = ($_POST["correo"]);
//
//                        $usuario = new Usuario($documento, $nombres, $apellido1, $apellido2, $correo, $clave);
//
//                        if ($usuarioDAO->updateTablaUsuarios($usuario)) {
//                            $usuario->_SET($documento);
//                            $usuario->_SET($nombres);
//                            $usuario->_SET($apellido1);
//                            $usuario->_SET($apellido2);
//                            $usuario->_SET($correo);
//                        }
                    }
                    ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="documento">Documento:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="documento" name="documento" value="">     
                            </div> 
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="nombres">Nombres:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nombres" name="nombres">        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="apellido1">Primer Apellido:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="apellido1" name="apellido1">         
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="apellido1">Segundo Apellido:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="apellido2" name="apellido2">         
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="correo">Correo:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="correo" name="correo"> 
                            </div>
                        </div>
                </div >
            </div >
            <?php
                include ("footer.php");
            ?>

        </div >
                    </form>

        <script type = "text/javascript">
            $().ready(function () {
                $('#form_registrar_usuario').formValidation({
                    message: 'Este valor no es correcto',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        tipoDoc: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione un tipo de documento'
                                }
                            }
                        },
                        documento: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El número de documento es obligatorio'
                                },
                                stringLength: {
                                    min: 4,
                                    max: 15,
                                    message: 'El número de documento debe contener entre 4 y 15 caracteres'
                                },
                                regexp: {
                                    regexp: /^[0-9]+$/i,
                                    message: 'El número de documento debe contener sólo números'
                                }
                            }
                        },
                        nombre: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El nombre es obligatorio'
                                },
                                stringLength: {
                                    min: 3,
                                    max: 30,
                                    message: 'El nombre debe contener entre 3 y 30 caracteres'
                                },
                                regexp: {
                                    regexp: /^([a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{3,15}[ ]*){1}([a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{1,15}[ ]+){0,6}[a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{0,15}[ ]*$/,
                                    message: 'Solo letras'
                                }
                            }
                        },
                        primerApellido: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El primer apellido es obligatorio'
                                },
                                stringLength: {
                                    min: 3,
                                    max: 30,
                                    message: 'El primer apellido debe contener entre 3 y 30 caracteres'
                                },
                                regexp: {
                                    regexp: /^([a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{3,15}[ ]*){1}([a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{1,15}[ ]+){0,6}[a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{0,15}[ ]*$/,
                                    message: 'El primer apellido no es válido'
                                }
                            }
                        },
                        segundoApellido: {
                            row: '.col-sm-5',
                            validators: {
                                stringLength: {
                                    max: 30,
                                    message: 'El segundo apellido debe contener menos de 30 caracteres'
                                },
                                regexp: {
                                    regexp: /^([a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{3,15}[ ]*){1}([a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{1,15}[ ]+){0,6}[a-zA-ZáéíóúñÁÉÍÓÚÑäëïöüÄËÏÖÜ]{0,15}[ ]*$/,
                                    message: 'El segundo apellido no es válido'
                                }
                            }
                        },
                        correo: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El correo es obligatorio'
                                },
                                regexp: {
                                    regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/,
                                    message: 'El correo no tiene un formato válido'
                                }
                            }
                        },
                        rol: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione una opción'
                                }
                            }
                        },
                        contrasena: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'La contraseña es obligatoria'
                                },
                                stringLength: {
                                    min: 6,
                                    message: 'La contraseña debe contener mínimo 6 caracteres'
                                }
                            }
                        },
                        confircontrasena: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'La confirmación de la contraseña es obligatoria'
                                },
                                identical: {
                                    field: 'contrasena',
                                    message: 'La confirmación no coincide con la contraseña'

                                }
                            }
                        }
                    }
                });
            });
            
        </script>
    </body>
</html>