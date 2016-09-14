<?php
include ("header.php");
if (!empty($_SESSION['usuario'])) {
require_once '../model/dto/Usuario.class.php';
require_once '../model/dto/Examen.class.php';
require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
require_once '../model/dao/implementacion/TiposDocumentoMySqlDAO.class.php';
require_once '../model/dao/implementacion/RolesMySqlDAO.class.php';
require_once '../model/dao/implementacion/FichasMySqlDAO.class.php';
require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
require_once '../model/dao/implementacion/EstadosExamenesMySqlDAO.class.php';
require_once '../model/dao/implementacion/ExamenesMySqlDAO.class.php';

$profesor = $_SESSION['usuario']['idusuario'];
$usuarioDAO = new UsuariosMySqlDAO();
$tipoDocDAO = new TiposDocumentoMySqlDAO();
$rolesDAO = new RolesMySqlDAO();
$fichasDAO = new FichasMySqlDAO();
$cursosDAO = new CursosMySqlDAO();
$estadosDAO = new EstadosExamenesMySqlDAO();
$examenesDAO = new ExamenesMySqlDAO();
$tipoDoc = $tipoDocDAO->listarTodos();
$roles = $rolesDAO->listarTodos();
$cursos = $cursosDAO->listarTodos();
$fichas = $fichasDAO->listarTodos();
$estados = $estadosDAO->listarTodos();
$curso = "";
$fechaInicial = "";
$fechaFinal = "";
$ficha = "";
$estado = "";
if (isset($_POST['registrar-examen'])) {
    $curso = ($_POST["curso"]);
    $fechaInicial = ($_POST["fechaInicial"]);
    $fechaFinal = ($_POST["fechaFinal"]);
    $ficha = ($_POST["ficha"]);
    $estado = ($_POST["estado"]);
    $examenesDAO->insertar(new Examen($curso, $profesor, $fechaInicial, $fechaFinal, $estado,$ficha));
    $curso = "";
    $fechaInicial = "";
    $fechaFinal = "";
    $ficha = "";
    $estado = "";
}
?>
<div class="page-header">
    <h2>Crear Examen</h2>
</div>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<form id="form_registrar_usuario" method="post" class="form-horizontal" action="crear-examen.php">
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="curso">Nombre del curso:</label>
        <div class="col-sm-5">
            <select id="curso" name="curso" class="form-control">
                <option value="" disabled selected>Seleccione un curso</option>
                <?php
                foreach ($cursos as $fila) {
                    echo '<option value="' . $fila['idcurso'] . '">' . $fila['nombrecurso'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="fechaInicial">Fecha Inicial:</label>
        <div class="col-sm-5">
            <input type="date" id="fechaInicial" name="fechaInicial" placeholder="dd/mm/yyyy" class="form-control" value="<?= $fechaInicial; ?>"></input>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="fechaFinal">Fecha Final:</label>
        <div class="col-sm-5">
            <input type="date" id="fechaFinal" name="fechaFinal" placeholder="dd/mm/yyyy" class="form-control" value="<?= $fechaFinal; ?>"></input>
        </div>
    </div> 
    <div class="form-group">
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
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="estado">Estado:</label>
        <div class="col-sm-5">
            <select id="estado" name="estado" class="form-control">
                <option value="" disabled selected>Seleccione el estado</option>
                <?php
                foreach ($estados as $fila) {
                    echo '<option value="' . $fila['idestadoexamen'] . '">' . $fila['nombreestadoexamen'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="estado">Tipo de Examen:</label>
        <div class="col-sm-5">
            <select id="estado" name="estado" class="form-control">
                <option value="" disabled selected>Seleccione el tipo de examen</option>
                <option value="1">Manual</option>
                <option value="2">Automático</option>
            </select>
        </div>
    </div> 
    <hr>
    
    <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" name="registrar-examen"
            value="registrar-examen">Registrar
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
}
else{
    echo 'Acceso denegado, por favor inicie sesión';
}
?>
        