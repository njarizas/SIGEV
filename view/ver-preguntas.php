<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==2) {
require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
require_once '../model/dao/implementacion/RespuestasMySqlDAO.class.php';
require_once '../model/dto/Pregunta.class.php';
require_once '../model/dto/Respuesta.class.php';
$fichasDAO = new CursosMySqlDAO();
$preguntasDAO = new PreguntasMySqlDAO();
$respuestasDAO = new RespuestasMySqlDAO();
?>
    <h4>Ver Preguntas</h4><hr>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<?php
$preguntaslis = $preguntasDAO->listarTodos();
if (count($preguntaslis) > 0) {
    echo '<form action="ver-pregunta.php" method="post">';
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td><strong>Id Pregunta</strong></td><td><strong>Enunciado</strong></td><td><strong>Nombre Curso</strong></td><td></td></tr>';
}
foreach ($preguntaslis as $fila) {
    echo '<tr><td>' . $fila['idpregunta'] . '</td>';
    echo '<td>' . $fila['enunciado'] . '</td>';
    echo '<td>' . $fila['nombrecurso'] . '</td>';
    echo '<td><button type="submit" class="btn btn-primary" name="pregunta" value="'. $fila['idpregunta'] .'">Ver</button></td></tr>';
}
echo '</table></div></div></form>';
include ("footer.php");}
else {
echo 'Acceso denegado, por favor inicie sesión';
}
?>