<?php
include("header.php");
require_once '../model/dto/Usuario.class.php';
require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
require_once '../model/dao/implementacion/TiposDocumentoMySqlDAO.class.php';
require_once '../model/dao/implementacion/RolesMySqlDAO.class.php';
require_once '../model/dao/implementacion/FichasMySqlDAO.class.php';

$usuarioDAO = new UsuariosMySqlDAO();
$tipoDocDAO = new TiposDocumentoMySqlDAO();
$rolesDAO = new RolesMySqlDAO();
$fichasDAO = new FichasMySqlDAO();
$tipoDoc = $tipoDocDAO->listarTodos();
$roles = $rolesDAO->listarTodos();
$fichas = $fichasDAO->listarTodos();
$idtipoDoc = "";
$documento = "";
$nombres = "";
$apellido1 = "";
$apellido2 = "";
$correo = "";
$contrasena = "";
$confirmaContrasena = "";
$ficha="";
$rol="";
if (isset($_POST['registrar-usuario'])) {
    $idtipoDoc = ($_POST["tipoDoc"]);
    $documento = ($_POST["documento"]);
    $nombres = ($_POST["nombre"]);
    $apellido1 = ($_POST["primerApellido"]);
    $apellido2 = ($_POST["segundoApellido"]);
    $correo = ($_POST["correo"]);
    $contrasena = ($_POST["contrasena"]);
    $confirmaContrasena = ($_POST["confircontrasena"]);
    $ficha = ($_POST["ficha"]);
    $rol = ($_POST["rol"]);
    $usuario = new Usuario($idtipoDoc, $documento, $nombres, $apellido1, $apellido2, $correo, md5(sha1($contrasena)),$ficha,$rol);
    $usuExiste = $usuarioDAO->obtenerUsuarioPorDocumento($documento);
    $usuExiste2 = $usuarioDAO->obtenerUsuarioPorCorreo($correo);
    if ($usuExiste->rowCount() > 0) {
        echo "<script>swal(\"Registro fallido\",\"ya existe un usuario registrado con documento " . $usuario->getDocumento() . "\", \"error\");</script>";
    } else if ($usuExiste2->rowCount() > 0) {
        echo "<script>swal(\"Registro fallido\",\"ya existe un usuario registrado con correo " . $usuario->getCorreo() . "\", \"error\");</script>";
    } elseif ($usuarioDAO->insertar($usuario) > 0) {
        echo "<script>swal(\"Registro exitóso\", \"El usuario: " . $usuario->getCorreo() . " fue registrado exitósamente \", \"success\");</script>";
        $idtipoDoc = "";
        $documento = "";
        $nombres = "";
        $apellido1 = "";
        $apellido2 = "";
        $correo = "";
        $contrasena = "";
        $confirmaContrasena = "";
        $ficha="";
        $rol="";
    }
}
?>
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
        <label class="col-sm-3 col-sm-offset-2 control-label" for="tipoDoc">Tipo de Documento:</label>
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
        <label class="col-sm-3 col-sm-offset-2 control-label" for="documento">Número de documento:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="documento" name="documento" maxlength="14"
                   placeholder="1030615297" value="<?= $documento; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="nombre">Nombres:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30"
                   placeholder="Carlos Alberto" required value="<?= $nombres; ?>">
        </div>
    </div>
    <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="primerApellido">Primer Apellido:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="primerApellido" name="primerApellido" maxlength="30"
                   placeholder="Cardenas" required value="<?= $apellido1; ?>">
        </div>
    </div>
    <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="segundoApellido">Segundo
            Apellido:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="segundoApellido"
                   name="segundoApellido" maxlength="30" placeholder="Lopez" value="<?= $apellido2; ?>">
        </div>
    </div>
    <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="correo">Correo electrónico:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="correo" name="correo"
                   placeholder="micorreo@midominio.com" required value="<?= $correo; ?>">
        </div>
    </div>
    <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="contrasena">Crea tu
            contraseña:</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="contrasena"
                   name="contrasena" placeholder="" required
                   value="<?= $contrasena; ?>">
        </div>
    </div>
    <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="confircontrasena">Confirma tu
            contraseña:</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="confircontrasena"
                   name="confircontrasena" placeholder="" required
                   value="<?= $confirmaContrasena; ?>">
        </div>
    </div>
     <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="ficha">Ficha:</label>
        <div class="col-sm-5">
            <select id="ficha" name="ficha" class="form-control">
                <option value="" disabled selected>Seleccione la ficha</option>
                <?php
                foreach ($fichas as $fila) {
                    echo '<option value="' . $fila['ficha'] . '">' . $fila['ficha'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>  
    <div class=" form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="rol">Rol:</label>
        <div class="col-sm-5">
            <select id="rol" name="rol" class="form-control">
                <option value="" disabled selected>Seleccione un rol</option>
                <?php
                foreach ($roles as $fila) {
                    echo '<option value="' . $fila['idrol'] . '">' . $fila['nombrerol'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>        
    <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" name="registrar-usuario"
            value="registrar-usuario">Registrar
    </button>
</form>
<br>
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
<?php
include ("footer.php");
?>
        