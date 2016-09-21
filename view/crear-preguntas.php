<?php
include ("header.php");
if (!empty($_SESSION['usuario'])) {
require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
require_once '../model/dao/implementacion/RespuestasMySqlDAO.class.php';
require_once '../model/dto/Pregunta.class.php';
require_once '../model/dto/Respuesta.class.php';
$fichasDAO = new CursosMySqlDAO();
$preguntasDAO = new PreguntasMySqlDAO();
$respuestasDAO = new RespuestasMySqlDAO();
$tiposDoc = $fichasDAO->listarTodos();
if (isset($_POST['registrar-pregunta'])) {
    $idCurso = ($_POST["curso"]);
    $enunciado = ($_POST["enunciado"]);
    $respuestaCorrecta = ($_POST["respuestaCorrecta"]);
    $pregunta = new Pregunta($enunciado, 0, $idCurso);
    $respuestaErronea[0] = ($_POST["respuestaErronea1"]);
    $respuestaErronea[1] = ($_POST["respuestaErronea2"]);
    $respuestaErronea[2] = ($_POST["respuestaErronea3"]);
    $respuestaErronea[3] = ($_POST["respuestaErronea4"]);
    if ($preguntasDAO->insertar($pregunta) > 0) {
        $ultimoRegistroPreguntas = $preguntasDAO->obtenerUltimoRegistroInsertado();
        foreach ($ultimoRegistroPreguntas as $fila) {
            if ($pregunta->getEnunciado() == $fila['enunciado'] && $pregunta->getIdCurso() == $fila['idcurso']) {
                $pregunta->setIdPregunta($fila['idpregunta']);
                $objRespuestaCorrecta = new Respuesta($pregunta->getIdPregunta(), $respuestaCorrecta);
            }
        }
        if ($respuestasDAO->insertar($objRespuestaCorrecta) > 0) {
            $ultimoRegistroRespuestas = $respuestasDAO->obtenerUltimoRegistroInsertado();
            foreach ($ultimoRegistroRespuestas as $fila2) {
                if ($objRespuestaCorrecta->getIdPregunta() == $fila2['idpregunta'] &&
                        $objRespuestaCorrecta->getRespuesta() == $fila2['respuesta']) {
                    $pregunta->setValorPregunta($fila2['idrespuesta']);
                }
            }
            $preguntasDAO->actualizar($pregunta);
            for ($i = 0; $i < 4; $i++) {
                $respuesta = new Respuesta($pregunta->getIdPregunta(), $respuestaErronea[$i]);
                $respuestasDAO->insertar($respuesta);
            }
            echo "<script>swal(\"Registro exitóso\", \"La pregunta: " . $pregunta->getEnunciado() . " fue registrada exitósamente \", \"success\");</script>";
        }
    }
}
$enunciado = "";
$respuestaCorrecta = "";
$respuestaErronea[0] = "";
$respuestaErronea[1] = "";
$respuestaErronea[2] = "";
$respuestaErronea[3] = "";
?>
    <h4>Crear Preguntas</h4><hr>
<noscript>
<p class="text-danger">
    Debe habilitar el JavaScript en su navegador!!!
</p>
</noscript>

<form id="form_registrar_pregunta" method="post" class="form-horizontal" action="crear-preguntas.php" >
    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="curso">Nombre del curso:</label>
        <div class="col-sm-5">
            <select id="curso" name="curso" class="form-control">
                <option value="" disabled selected>Seleccione un curso</option>
                <?php
                foreach ($tiposDoc as $fila) {
                    echo '<option value="' . $fila['idcurso'] . '">' . $fila['nombrecurso'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="enunciado">Enunciado de la pregunta:</label>
        <div class="col-sm-5">
            <input type="textarea" class="form-control" id="enunciado" name="enunciado" placeholder="" value="<?= $enunciado; ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="respuestaCorrecta">Respuesta correcta:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="RespuestaCorrecta" name="respuestaCorrecta" placeholder="" value="<?= $respuestaCorrecta; ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="respuestaErronea1">Respuesta erronea 1:</label>
        <div class="col-sm-5"> 
            <input type="text" class="form-control" id="respuestaErronea1" name="respuestaErronea1" placeholder="" value="<?= $respuestaErronea[0]; ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="respuestaErronea2">Respuesta erronea 2:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="respuestaErronea2" name="respuestaErronea2" placeholder="" value="<?= $respuestaErronea[1]; ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="respuestaErronea3">Respuesta erronea 3:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="respuestaErronea3" name="respuestaErronea3" placeholder="" value="<?= $respuestaErronea[2]; ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 col-sm-offset-2 control-label" for="respuestaErronea4">Respuesta erronea 4:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="respuestaErronea4" name="respuestaErronea4" placeholder="" value="<?= $respuestaErronea[3]; ?>" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary col-xs-3 col-xs-offset-7" id="registrar-pregunta" name="registrar-pregunta" value="registrar">Crear Pregunta</button>
</form>
<br>
<script type="text/javascript">
    $().ready(function () {
        $('#form_registrar_pregunta').formValidation({
            message: 'Este valor no es correcto',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                curso: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'Este Campo es obligatorio'
                        }
                    }
                },
                enunciado: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'El enunciado de la pregunta es obligatorio'
                        },
                        stringLength: {
                            min: 10,
                            max: 300,
                            message: 'El enunciado debe contener entre 10 y 300 caracteres'
                        }
                    }
                },
                respuestaCorrecta: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'Este Campo es obligatorio'
                        }
                    }
                },
                respuestaErronea1: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'Este Campo es obligatorio'
                        }
                    }
                },
                respuestaErronea2: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'Este Campo es obligatorio'
                        }
                    }
                },
                respuestaErronea3: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'Este Campo es obligatorio'
                        }
                    }
                },
                respuestaErronea4: {
                    row: '.col-sm-5',
                    validators: {
                        notEmpty: {
                            message: 'Este Campo es obligatorio'
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