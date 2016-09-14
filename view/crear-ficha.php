<?php
include ("header.php");
if (!empty($_SESSION['usuario'])) {
require_once '../model/dao/implementacion/FichasMySqlDAO.class.php';
$fichasDAO = new FichasMySqlDAO();
if (isset($_POST['registrar-ficha'])) {
    $ficha = ($_POST["ficha"]);
    if ($fichasDAO->insertar($ficha) > 0) {
        echo "<script>swal(\"Registro exitóso\", \"La ficha: " . $ficha . " fue registrada exitósamente \", \"success\");</script>";
    }
}
 $ficha = "";
?>
<div class="page-header">
    <h2>Crear Fichas</h2>
</div>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<form id="form_registrar_ficha" method="post" class="form-horizontal" action="crear-ficha.php">
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="ficha">Número Ficha:</label>
        <div class="col-sm-5">
            <input type="number" class="form-control" id="nombreCurso" name="ficha" placeholder="Ej: 954738" value="<?= ficha; ?>" maxlength="10" required>
        </div>
    </div>
            <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" name="registrar-ficha" value="registrar-ficha">Crear Ficha</button>
</form>
<br>
<hr>
<br>
<?php
$tiposDoc = $fichasDAO->listarTodos();
if (count($tiposDoc) > 0) {
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td>Id Ficha</td><td>Número Ficha</td></tr>';
}
foreach ($tiposDoc as $fila) {
    echo '<tr><td>' . $fila['id'] . '</td>';
    echo '<td>' . $fila['ficha'] . '</td></tr>';
}
echo '</table></div></div>';
?>
<script type="text/javascript">
    $().ready(function () {
        $('#form_registrar_ficha').formValidation({
            message: 'Este valor no es correcto',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ficha: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'El número de ficha es obligatorio'
                        },
                        stringLength: {
                            min: 6,
                            max: 10,
                            message: 'El número de ficha debe contener entre 6 y 10 caracteres'
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