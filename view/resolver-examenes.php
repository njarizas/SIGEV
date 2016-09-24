<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==1) {
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
$idEstudiante = $_SESSION['usuario']['idusuario'];
$examenlis = $examenesDAO->listarExamenesPorEstudiante($idEstudiante);
if ($examenlis->rowCount() > 0) {
    echo '<form action="resolver-examen.php" method="post">';
    echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2"><table border="1" class="table table-hover"><tr><td><strong>Fecha Inicio</strong></td><td><strong>Fecha Fin</strong></td><td><strong>Curso</strong></td><td><strong>Estado</strong></td></tr>';
         $hoy = date("Y-m-d");
        $tmp = explode('-', $hoy);
        $fechaHoy = mktime(0, 0, 0, $tmp[1], $tmp[2], $tmp[0]);
foreach ($examenlis as $fila) {
    $fechaInicial = $fila['fechainicio'];
    $fechaFinal = $fila['fechafin'];
     $strIni = explode('-', $fechaInicial);
        $fechaIni = mktime(0, 0, 0, $strIni[1], $strIni[2], $strIni[0]);
        $strFin = explode('-', $fechaFinal);
        $fechaFin = mktime(0, 0, 0, $strFin[1], $strFin[2], $strFin[0]);
    echo '<tr><td>' . date("Y-m-d" , $fechaIni) . '</td>';
    echo '<td>' . date("Y-m-d" , $fechaFin) . '</td>';
    echo '<td>' . $fila['nombrecurso'] . '</td>';
    if(date("U" , $fechaHoy)<date("U", $fechaIni)){
        echo '<td><a class="btn btn-primary" href="#">Programado</a></td></tr>';
    }
    else if(date("U" , $fechaHoy)>date("U", $fechaFin)){
        echo '<td><a class="btn btn-warning" href="#">Vencido</a></td></tr>';
    }
    else{
          echo '<td><button type="submit" class="btn btn-success" name="examen" value="'. $fila['idexamen'] .'">Activo</button></td></tr>';
    }
}
echo '</table></div></div></form>';
}
include ("footer.php");}
else {
echo 'Acceso denegado, por favor inicie sesión';
}
?>