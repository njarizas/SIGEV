<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==3) {
require_once '../model/dto/Usuario.class.php';
require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
require_once '../model/dao/implementacion/TiposDocumentoMySqlDAO.class.php';
$usuarioDAO = new UsuariosMySqlDAO();
?>
<form id="editar-usuario" method="POST" class="form-horizontal" action="editar-usuario.php">
        <h4>Lista de usuarios</h4>
    <hr>
    <?php
    $usuarioslis = $usuarioDAO->listarTodos();
    if (count($usuarioslis) > 0) {
        echo '<div class="row"><div class="col-xs-12 col-sm-10 col-sm-offset-1">'
        . '<table border="1" class="table table-hover">'
        . '<tr><td>Documento</td><td>Nombres</td><td>Apellidos</td><td>Correo</td>'
        . '<td>Acción a realizar</td></tr>';
    }
    foreach ($usuarioslis as $fila) {
        echo '<tr>'
        . '<td>' . $fila['documento'] . '</td>';
        echo'<td>' . $fila['nombres'] . '</td>';
        echo'<td>' . trim($fila['apellido1']) . ' ' . $fila['apellido2'] . '</td>';
        echo'<td>' . $fila['correo'] . '</td>';
        echo'<td> <button type="submit" class="btn btn-primary" action="editar-usuario"
                                        value="' . $fila['documento'] . '">Editar
                                </button> </td></tr>';
    }
    echo '</table></div></div>';
    ?>
</form>
<?php
include ("footer.php");}
else {
echo 'Acceso denegado, por favor inicie sesión';
}
?>