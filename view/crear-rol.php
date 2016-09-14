<?php
include ("header.php");
if (!empty($_SESSION['usuario'])) {
require_once '../model/dao/implementacion/RolesMySqlDAO.class.php';
$rolesDAO = new RolesMySqlDAO();
if (isset($_POST['registrar-rol'])) {
    $nombreRol = ($_POST["nombreRol"]);
    if ($rolesDAO->insertar($nombreRol) > 0) {
        echo "<script>swal(\"Registro exitóso\", \"El rol: " . $nombreRol . " fue registrado exitósamente \", \"success\");</script>";
    }
}
$nombreRol = "";
?>
<div class="page-header">
    <h2>Crear Roles</h2>
</div>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<form id="form_registrar_rol" method="post" class="form-horizontal" action="crear-rol.php">
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="nombreRol">Nombre del Rol:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="nombreRol" name="nombreRol" placeholder="Ej: Estudiante" value="<?= $nombreRol; ?>" maxlength="45" required>
        </div>
    </div>
            <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" name="registrar-rol" value="registrar-rol">Crear Rol</button>
</form>
<br>
<hr>
<br>
<?php
$roles = $rolesDAO->listarTodos();
if (count($roles) > 0) {
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td>Id Rol</td><td>Nombre Rol</td></tr>';
}
foreach ($roles as $fila) {
    echo '<tr><td>' . $fila['idrol'] . '</td>';
    echo '<td>' . $fila['nombrerol'] . '</td></tr>';
}
echo '</table></div></div>';
?>
<script type="text/javascript">
    $().ready(function () {
        $('#form_registrar_rol').formValidation({
            message: 'Este valor no es correcto',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombreRol: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'El nombre del rol es obligatorio'
                        },
                        stringLength: {
                            min: 6,
                            max: 45,
                            message: 'El nombre del rol debe contener entre 6 y 45 caracteres'
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