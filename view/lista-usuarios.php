<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registro Usuario</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/formValidation.min.css"> <!-- NEW!!! -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formValidation.min.js"></script> <!-- NEW!!! -->
        <script src="js/bootstrap.js"></script> <!-- NEW!!! -->
        <script src="js/es_ES.js"></script> <!-- NEW!!! -->
        <script src="js/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
    </head>
    <body>    
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
                        . '<tr><td>Documento</td><td>Nombres</td><td>Apellidos</td><td>Correo</td></tr>';
                    }
                    foreach ($usuarioslis as $fila) {
                        echo '<tr><td>' . $fila['documento'] . '</td>';
                        echo '<td>' . $fila['nombres'] . '</td>';
                        echo '<td>' . trim($fila['apellido1']) . ' ' . $fila['apellido2'] . '</td>';
                        echo '<td>' . $fila['correo'] . '</td></tr>';
                    }
                    echo '</table></div></div>';
                    include ("footer.php");
                    ?>
                </div >
            </div >
        </div >

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