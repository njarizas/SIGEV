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
    $idPregunta=0;
$preguntaslis = $preguntasDAO->listarTodos();
      if (isset($_POST['pregunta'])) {
        $idPregunta = (empty($_POST["pregunta"]) ? "" : $_POST["pregunta"]);
             $infoPregunta=$preguntasDAO->verPregunta($idPregunta);
      }
?>
<form id="form_ver_pregunta" method="post" class="form-horizontal" action="ver-pregunta.php" >
    <div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="curso">Nombre del curso:</label>
        <div class="col-sm-5">
            <select id="pregunta" name="pregunta" class="form-control">
                <option value="" disabled selected>Seleccione un curso</option>
                <?php
                foreach ($preguntaslis as $fila) {
                    echo  $fila['idpregunta'] ;
                    echo '<option value="' . $fila['idpregunta'] . '">' . $fila['enunciado'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" id="ver-pregunta" name="ver-pregunta" value="ver-pregunta">Ver</button>
        </div></div><hr>
    <div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
<?php
    if($idPregunta!=0)   {
        $i=0;
          foreach ($infoPregunta as $row) {
              if($i===0){
                   echo '<h3>'.$row['enunciado'].'</h3>';
              }
              echo chr($i+65). '. ' .$row['respuesta'].'<br>';
              $i++;
          }
    }
    echo '</div></div></form>';
    ?>
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