<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==1) {
    require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
    require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
    require_once '../model/dao/implementacion/RespuestasMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ExamenesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ResultadosExamenesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ResultadosPreguntasMySqlDAO.class.php';
    require_once '../model/dto/Pregunta.class.php';
    require_once '../model/dto/Respuesta.class.php';
    require_once '../model/dto/Examen.class.php';
    require_once '../model/dto/ResultadoExamen.class.php';
    require_once '../model/dto/ResultadoPregunta.class.php';
    $fichasDAO = new CursosMySqlDAO();
    $preguntasDAO = new PreguntasMySqlDAO();
    $respuestasDAO = new RespuestasMySqlDAO();
    $examenesDAO = new ExamenesMySqlDAO();
    $resultadosExamenesDAO = new ResultadosExamenesMySqlDAO();
    $resultadosPreguntasDAO = new ResultadosPreguntasMySqlDAO();
    $estudiante = $_SESSION['usuario']['idusuario'];
    ?>
    <h4>Ver Examen</h4><hr>
    <noscript>
    <p class="text-danger">
        Debe habilitar el JavaScript en su navegador!!!
    </p>
    </noscript>
    <?php
    $idExamen = 0;
    if (isset($_POST['responder'])) {
        $idExamen = (empty($_POST["examen"]) ? "" : $_POST["examen"]);
        $p = (empty($_POST["p"]) ? "" : $_POST["p"]);
        ?>
        <div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <?php
                if ($resultadosExamenesDAO->insertar(new ResultadoExamen($estudiante, $idExamen, 0)) > 0) {
                    $idResultadoExamen = $resultadosExamenesDAO->obtenerUltimoRegistroInsertado()['idresultadoexamen'];
                    foreach ($p as $respuestaPreguna) {
//                    echo $respuestaPreguna . '<br>';
                        $tmp = explode(';', $respuestaPreguna);
                        $idPregunta = $tmp[0];
                        $idRespuesta = $tmp[1];
                        $resultadosPreguntasDAO->insertar(new ResultadoPregunta($idResultadoExamen, $idPregunta, $idRespuesta));
                    }
                    echo "<script>swal(\"Registro exitóso\", \"Su respuesta al examen ha sido registrada \", \"success\");</script>";
                } else {
                    echo "<script>swal(\"Error\", \"Ocurrió un error al tratar de registrar su respuesta del examen por favor comuníquese"
                    . " con el administrador \", \"error\");</script>";
                }
                echo '</div></div>';
            }
            if (isset($_POST['examen']) || isset($_POST['responder'])) {
                $idExamen = (empty($_POST["examen"]) ? "" : $_POST["examen"]);
                $infoExamen = $examenesDAO->verExamen($idExamen);
                ?>
                <form id="form_responder_examen" method="post" class="form-horizontal" 
                      action="resolver-examen.php">
                    <input type="hidden" id="examen" name="examen" value="<?= $idExamen ?>">
                    <div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                            <?php
                            $j = 0;
                            foreach ($infoExamen as $row) {
                                $idPregunta = $row['idpregunta'];
                                $infoPregunta = $preguntasDAO->verPregunta($idPregunta);
                                $i = 0;
                                echo '<h4>Pregunta ' . ($j + 1) . '</h4>';
                                foreach ($infoPregunta as $fila) {
                                    if ($i === 0) {
                                        echo '<h3>' . $fila['enunciado'] . '</h3>';
                                    }
                                    echo '<input type="radio" name="p[' . $j . ']" value=' . $fila['idpregunta'] . ';' . $fila['idrespuesta'] . '>' . chr($i + 65) . '. ' . $fila['respuesta'] . '<br>';
                                    $i++;
                                }
                                $j++;
                                echo '<hr>';
                            }
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" 
                                        id="responder" name="responder"
                                        value="responder">Guardar y Enviar
                                </button>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </form>
            <?php
            include ("footer.php");
        } else {
            echo 'Acceso denegado, por favor inicie sesión';
        }
        ?>