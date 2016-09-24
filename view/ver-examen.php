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
    <h4>Ver Examen</h4><hr>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>
<?php
    $idExamen=0;
      if (isset($_POST['examen'])) {
        $idExamen = (empty($_POST["examen"]) ? "" : $_POST["examen"]);
             $infoExamen=$examenesDAO->verExamen($idExamen);
      
?>
    <div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
<?php
          $j = 0;
          foreach ($infoExamen as $row) {
              $idPregunta=$row['idpregunta'];
              $infoPregunta=$preguntasDAO->verPregunta($idPregunta);
              $i=0;
              echo '<h4>Pregunta '.($j+1).'</h4>';
              foreach ($infoPregunta as $fila) {
              if($i===0){
                   echo '<h3>'.$fila['enunciado'].'</h3>';
              }
              echo chr($i+65). '. ' .$fila['respuesta'].'<br>';
              $i++;
              }
              $j++;
              echo '<hr>';
          }
          }
    ?>
         </div></div>
         <script type = "text/javascript">
        $().ready(function () {
            $('#pregunta').val('<?= empty($idPregunta) ? '' : $idPregunta ?>');
        });
        </script>
        <?php
include ("footer.php");}
else {
echo 'Acceso denegado, por favor inicie sesión';
}
?>