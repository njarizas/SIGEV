
<?php

require_once 'class/config/Database.class.php';
//require_once 'class/dao/TipoDocumentoDao.php';
require_once 'class/dao/TipoDocumentoDaoImplementacion.php';

//echo phpinfo();
$conexion = Database::connect();
$tipoDocDao = new TipoDocumentoDaoImplementacion();
if (!$conexion) {
    echo 'hay un error';
} else {
    echo 'bien';
}

$query = "SELECT * "
        . "FROM TiposDocumentos";
//$stmt=$conexion->prepare($query);
//$stmt->execute();
//$lista=$stmt->fetchAll($PDO::FETCH_OBJ);
//foreach ($lista as $key) {
//    echo $key->idTipoDocumento;
//    echo $key->nombreDocumento;
//}
echo '<table border="1"><tr><td>Id Doc</td><td>Documento</td></tr>';
foreach ($conexion->query($query) as $fila) {
    echo '<tr><td>'.$fila['idtipodocumento'].'</td>';
    echo '<td>'.$fila['nombredocumento'].'</td></tr>';
}
echo '</table>';
$tipoDocDao->insertar('Pasaporte');
?>
