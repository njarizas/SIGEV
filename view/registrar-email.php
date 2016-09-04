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

                    <div class="page-header">
                        <h2>Registro Usuario</h2>
                    </div>

                    <noscript>
                    <p class="text-danger">
                        Debe habilitar el JavaScript en su navegador!!!
                    </p>
                    </noscript>

                    <form id="form_registrar_usuario" method="post" class="form-horizontal" action="./../controlador/UsuarioFacade.php">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="tipoDoc">Tipo de Documento:</label>
                            <div class="col-sm-5">
                                <select id="tipoDoc" name="tipoDoc" class="form-control">
                                    <option value="" disabled selected>Seleccione tipo de documento</option>
                                    <?php
                                    foreach ($tipoDoc as $fila) {
                                        echo '<option value="' . $fila['idtipodocumento'] . '">' . $fila['nombredocumento'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="documento">Número de documento:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="documento" name="documento" maxlength="14"
                                       placeholder="1030615297" value="<?= $documento; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="nombre">Nombres:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30"
                                       placeholder="Carlos Alberto" required value="<?= $nombres; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="primerApellido">Primer Apellido:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="primerApellido" name="primerApellido" maxlength="30"
                                       placeholder="Cardenas" required value="<?= $apellido1; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="segundoApellido">Segundo
                                Apellido:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="segundoApellido"
                                       name="segundoApellido" maxlength="30" placeholder="Lopez" value="<?= $apellido2; ?>">
                            </div>
                        </div>

                        <div class=" form-group">
                            <label class="col-sm-3 control-label" for="correo">Correo electrónico:</label>
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
                    <?php
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