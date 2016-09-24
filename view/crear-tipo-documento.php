<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==3) {
require_once '../model/dao/implementacion/TiposDocumentoMySqlDAO.class.php';
$tipoDocDAO = new TiposDocumentoMySqlDAO();
if (isset($_POST['registrar-tipo-documento'])) {
    $nombreTipoDoc = ($_POST["nombreTipoDoc"]);
    if ($tipoDocDAO->insertar($nombreTipoDoc) > 0) {
        echo "<script>swal(\"Registro exitóso\", \"El tipo de documento: " . $nombreTipoDoc . " fue registrado exitósamente \", \"success\");</script>";
    }
}
$nombreTipoDoc = "";
?>
    <h4>Crear Tipo de Documento</h4>
<hr>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<form id="form_registrar_tipo_doc" method="post" class="form-horizontal" action="crear-tipo-documento.php">
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="nombreTipoDoc">Nombre del Tipo de Documento:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="nombreTipoDoc" name="nombreTipoDoc" placeholder="Ej: Cédula de Ciudadanía" value="<?= $nombreTipoDoc; ?>" maxlength="45" required>
        </div>
    </div>
            <button type="submit" class="btn btn-primary col-xs-5 col-xs-offset-5" name="registrar-tipo-documento" value="registrar-tipo-documento">Crear Tipo de Documento</button>
</form>
<br>
<hr>
<br>
<?php
$tiposDoc = $tipoDocDAO->listarTodos();
if (count($tiposDoc) > 0) {
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td>Id Documento</td><td>Nombre Tipo Documento</td></tr>';
}
foreach ($tiposDoc as $fila) {
    echo '<tr><td>' . $fila['idtipodocumento'] . '</td>';
    echo '<td>' . $fila['nombredocumento'] . '</td></tr>';
}
echo '</table></div></div>';
?>
<script type="text/javascript">
    $().ready(function () {
        $('#form_registrar_tipo_doc').formValidation({
            message: 'Este valor no es correcto',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombreTipoDoc: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'El Nombre del tipo de documento es obligatorio'
                        },
                        stringLength: {
                            min: 6,
                            max: 45,
                            message: 'El Nombre del tipo de documento debe contener entre 6 y 45 caracteres'
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