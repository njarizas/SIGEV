<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==2) {
require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
require_once '../model/dao/implementacion/RespuestasMySqlDAO.class.php';
require_once '../model/dao/implementacion/ExamenesMySqlDAO.class.php';
require_once '../model/dto/Pregunta.class.php';
require_once '../model/dto/Respuesta.class.php';
require_once '../model/dto/Examen.class.php';
$fichasDAO = new CursosMySqlDAO();
$preguntasDAO = new PreguntasMySqlDAO();
$respuestasDAO = new RespuestasMySqlDAO();
$examenesDAO = new ExamenesMySqlDAO();
?>
    <h4>Ver Examenes</h4><hr>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<?php
$idProfesor = $_SESSION['usuario']['idusuario'];
$examenlis = $examenesDAO->listarExamenesPorProfesor($idProfesor);
if (count($examenlis) > 0) {
    echo '<form action="ver-examen.php" method="post">';
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2"><table border="1" class="table table-hover"><tr><td><strong>Fecha Inicio</strong></td><td><strong>Fecha Fin</strong></td><td><strong>Ficha</strong></td><td><strong>Curso</strong></td><td><strong>Estado</strong></td><td></td></tr>';
}
foreach ($examenlis as $fila) {
    echo '<tr><td>' . $fila['fechainicio'] . '</td>';
    echo '<td>' . $fila['fechafin'] . '</td>';
    echo '<td>' . $fila['ficha'] . '</td>';
    echo '<td>' . $fila['nombrecurso'] . '</td>';
    echo '<td>' . $fila['nombreestadoexamen'] . '</td>';
    echo '<td><button type="submit" class="btn btn-primary" name="examen" value="'. $fila['idexamen'] .'">Ver</button></td></tr>';
}
echo '</table></div></div></form>';
include ("footer.php");}
else {
echo 'Acceso denegado, por favor inicie sesión';
}
?>