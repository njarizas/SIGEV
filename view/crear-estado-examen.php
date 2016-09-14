<?php
include ("header.php");
if (!empty($_SESSION['usuario'])) {
require_once '../model/dao/implementacion/EstadosExamenesMySqlDAO.class.php';
$estadosExamenesDAO = new EstadosExamenesMySqlDAO();
if (isset($_POST['registrar-estado-examen'])) {
    $estadoExamen = ($_POST["estadoExamen"]);
    if ($estadosExamenesDAO->insertar($estadoExamen) > 0) {
        echo "<script>swal(\"Registro exitóso\", \"El estado de examen: " . $estadoExamen . " fue registrado exitósamente \", \"success\");</script>";
    }
}
$estadoExamen = "";
?>
<div class="page-header">
    <h2>Crear Estado de Examen</h2>
</div>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<form id="form_registrar_estado_examen" method="post" class="form-horizontal" action="crear-estado-examen.php">
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="estadoExamen">Nombre del Estado del Examen:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="estadoExamen" name="estadoExamen" placeholder="Ej: Activo" value="<?= $estadoExamen; ?>" maxlength="45" required>
        </div>
    </div>
            <button type="submit" class="btn btn-primary col-xs-5 col-xs-offset-5" name="registrar-estado-examen" value="registrar-estado-examen">Crear Estado de Examen</button>
</form>
<br>
<hr>
<br>
<?php
$estadosExamenes = $estadosExamenesDAO->listarTodos();
if (count($estadosExamenes) > 0) {
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td>Id Estado Examen</td><td>Nombre Estado Examen</td></tr>';
}
foreach ($estadosExamenes as $fila) {
    echo '<tr><td>' . $fila['idestadoexamen'] . '</td>';
    echo '<td>' . $fila['nombreestadoexamen'] . '</td></tr>';
}
echo '</table></div></div>';
?>
<script type="text/javascript">
    $().ready(function () {
        $('#form_registrar_estado_examen').formValidation({
            message: 'Este valor no es correcto',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                estadoExamen: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'El nombre del estado de examen es obligatorio'
                        },
                        stringLength: {
                            min: 6,
                            max: 45,
                            message: 'El nombre del estado de examen debe contener entre 6 y 45 caracteres'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
include ("footer.php");}
else {
echo 'Acceso denegado, por favor inicie sesión';
}
?>