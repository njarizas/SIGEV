<?php
include ("header.php");
require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
$cursosDAO = new CursosMySqlDAO();
if (isset($_POST['registrar-curso'])) {
    $nombreCurso = ($_POST["nombreCurso"]);
    if ($cursosDAO->insertar($nombreCurso) > 0) {
        echo "<script>swal(\"Registro exitóso\", \"El curso: " . $nombreCurso . " fue registrado exitósamente \", \"success\");</script>";
    }
}
$nombreCurso = "";
?>
<div class="page-header">
    <h2>Crear Cursos</h2>
</div>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<form id="form_registrar_curso" method="post" class="form-horizontal" action="crear-curso.php">
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
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td>Id Curso</td><td>Nombre Curso</td></tr>';
}
foreach ($cursos as $fila) {
    echo '<tr><td>' . $fila['idcurso'] . '</td>';
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
?>