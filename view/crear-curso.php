<?php
include ("header.php");
$nombreCurso = "";
$codigoCurso = "";
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==3) {
    require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
    $cursosDAO = new CursosMySqlDAO();
    if (isset($_POST['registrar-curso'])) {
        $nombreCurso = ($_POST["nombreCurso"]);
        $codigoCurso = ($_POST["codigoCurso"]);
        if (!$cursosDAO->existeCursoConCodigo($codigoCurso)) {
            if ($cursosDAO->insertar($nombreCurso,$codigoCurso) > 0) {
                echo "<script>swal(\"Registro exitóso\", \"El curso: " . $nombreCurso . " fue registrado exitósamente \", \"success\");</script>";
                $nombreCurso = "";
                $codigoCurso = "";
            } 
            else{
                echo "<script>swal(\"Error\", \"Ocurrio un error al tratar de registrar el curso ".$nombreCurso." con código " . $codigoCurso . " por favor comuníquese con el administrador del sistema\", \"error\");</script>";
            }
        }else {
                echo "<script>swal(\"Atención\", \"Ya existe un curso con código " . $codigoCurso . " por favor cámbielo e intente nuevamente\", \"warning\");</script>";
            }
    }
    ?>
        <h4>Crear Cursos</h4>
		<hr>
    <noscript>
    <p class="text-danger">
        Debe habilitar el JavaScript en su navegador!!!
    </p>
    </noscript>
    <form id="form_registrar_curso" method="post" class="form-horizontal" action="crear-curso.php">
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" for="codigoCurso">Código del Curso:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="codigoCurso" name="codigoCurso" placeholder="Ej: MAT" value="<?= $codigoCurso; ?>" maxlength="5" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" for="nombreCurso">Nombre del Curso:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" placeholder="Ej: Matemáticas" value="<?= $nombreCurso; ?>" maxlength="45" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" name="registrar-curso" value="registrar-curso">Crear Curso</button>
    </form>
    <br>
    <hr>
    <br>
    <?php
    $cursos = $cursosDAO->listarTodos();
    if (count($cursos) > 0) {
        echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">'
        . '<table border="1" class="table table-hover"><tr>'
        . '<td>Id</td>'
        . '<td>Codigo Curso</td>'
        . '<td>Nombre Curso</td></tr>';
    }
    foreach ($cursos as $fila) {
        echo '<tr><td>' . $fila['idcurso'] . '</td>';
        echo '<td>' . $fila['codigocurso'] . '</td>';
        echo '<td>' . $fila['nombrecurso'] . '</td></tr>';
    }
    echo '</table></div></div>';
    ?>
    <script type="text/javascript">
        $().ready(function () {
            $('#form_registrar_curso').formValidation({
                message: 'Este valor no es correcto',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    codigoCurso: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'El código del curso es obligatorio'
                            },
                            stringLength: {
                                min: 3,
                                max: 5,
                                message: 'El código del curso debe contener entre 3 y 5 caracteres'
                            }
                        }
                    },
                    nombreCurso: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'El nombre del curso es obligatorio'
                            },
                            stringLength: {
                                min: 6,
                                max: 45,
                                message: 'El nombre del curso debe contener entre 6 y 45 caracteres'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <?php
    include ("footer.php");
} else {
    echo 'Acceso denegado, por favor inicie sesión con rol administrativo';
}
?>