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
    </head>
    <body>
                <?php
                include("header.php");
                require_once '../model/dto/Usuario.class.php';
                require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
                require_once '../model/dao/implementacion/TiposdocumentosMySqlDAO.class.php';
                $usuarioDAO = new UsuariosMySqlDAO();
                $tipoDocDAO = new TiposdocumentosMySqlDAO();
                $tipoDoc = $tipoDocDAO->listarDoc();
                $confirmaContrasena = "";
                if (isset($_POST['registrar-usuario'])) {
                    $idtipoDoc = ($_POST["tipoDoc"]);
                    $documento = ($_POST["documento"]);
                    $nombres = ($_POST["nombre"]);
                    $apellido1 = ($_POST["primerApellido"]);
                    $apellido2 = ($_POST["segundoApellido"]);
                    $correo = ($_POST["correo"]);
                    $contrasena = ($_POST["contrasena"]);
                    $usuario = new Usuario($idtipoDoc, $documento, $nombres, $apellido1, $apellido2, $correo, $contrasena);
                    if ($usuarioDAO->insertar($usuario) > 0) {
                        echo "<script>alert('El usuario con correo \"".$usuario->getCorreo()."\" se registro exitosamente');</script>";
                    }
                }
                $idtipoDoc = "";
                $documento = "";
                $nombres = "";
                $apellido1 = "";
                $apellido2 = "";
                $correo = "";
                $contrasena = "";
                ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="page-header">
                        <h2>Registro Usuario</h2>
                    </div>

                    <noscript>
                    <p class="text-danger">
                        Debe habilitar el JavaScript en su navegador!!!
                    </p>
                    </noscript>

                    <form id="form_registrar_usuario" method="post" class="form-horizontal" action="registrar-usuario.php">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="tipoDoc">Tipo de Documento:</label>
                            <div class="col-sm-5">
                                <select id="tipoDoc" name="tipoDoc" class="form-control">
                                    <option value="" disabled selected>Seleccione tipo de documento</option>
                                    <?php
                                    foreach ($tipoDoc as $fila) {
                                        echo '<option value="'.$fila['idtipodocumento'].'">' . $fila['nombredocumento'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="documento">Número de documento:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="documento" name="documento"
                                       placeholder="1030615297" value="<?= $documento; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="nombre">Nombres:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       placeholder="Carlos Alberto" required value="<?= $nombres; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="primerApellido">Primer Apellido:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="primerApellido" name="primerApellido"
                                       placeholder="Cardenas" required value="<?= $apellido1; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="segundoApellido">Segundo
                                Apellido:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="segundoApellido"
                                       name="segundoApellido" placeholder="Lopez" value="<?= $apellido2; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="correo">Correo:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="correo" name="correo"
                                       placeholder="micorreo@midominio.com" required value="<?= $correo; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="contrasena">Crea tu
                                contraseña:</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" id="contrasena"
                                       name="contrasena" placeholder="" required
                                       value="<?= $contrasena; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="confircontrasena">Confirma tu
                                contraseña:</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" id="confircontrasena"
                                       name="confircontrasena" placeholder="" required
                                       value="<?= $confirmaContrasena; ?>">

                            </div>
                        </div>


                        <div class=" form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary" name="registrar-usuario"
                                        value="registrar-usuario">Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
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
                                    min: 2,
                                    max: 15,
                                    message: 'El nombre debe contener entre 6 y 15 caracteres'
                                },
                                regexp: {
                                    regexp: /^[0-9]+$/i,
                                    message: 'Solo números'
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
                                    regexp: /^[a-z\s]+$/i,
                                    message: 'Solo letras'
                                }
                            }
                        },
                        primerApellido: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El Apellido es obligatorio'
                                },
                                stringLength: {
                                    min: 3,
                                    max: 40,
                                    message: 'El nombre debe contener entre 3 y 40 caracteres'
                                },
                                regexp: {
                                    regexp: /^[a-z\s]+$/i,
                                    message: 'Solo letras'
                                }
                            }
                        },
                        correo: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El Correo Electrónico es obligatorio'
                                },
                                regexp: {
                                    regexp: /^[_a-zA-Z0-9-]*@[e-p-]+(.[c-o-]+)*(.[c-o-]+)$/,
                                    message: 'El correo no posee un dominio válido'
                                }
                            }
                        },
                        rol: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione una opción'
                                },
                            }
                        },
                        contrasena: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'La contraseña debe ser alfanúmerica y mínimo 8 caracteres'
                                },
                                stringLength: {
                                    min: 8,
                                    max: 26,
                                    message: 'El contraseña debe contener entre 8 y 26 caracteres'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9]+$/,
                                    message: 'La contraseña no puede contener caracteres especiales como *-/, etc.'
                                }
                            }
                        },
                        confircontrasena: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'La confirmación no coincide con la contraseña registrada'
                                },
                                identical: {
                                    field: 'contrasena',
                                    message: 'La confirmación no coincide con la contraseña'

                                }

                            }
                        },
                    }
                });
            });
        </script>

    </body>
</html>