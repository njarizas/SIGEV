<?php
include ("header.php");
if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['rol']==2) {
    require_once '../controller/ExamenFacade.php';

    require_once '../model/dto/Usuario.class.php';
    require_once '../model/dto/Examen.class.php';
    require_once '../model/dto/ExamenPregunta.class.php';
    require_once '../model/dao/implementacion/FichasMySqlDAO.class.php';
    require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
    require_once '../model/dao/implementacion/EstadosExamenesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ExamenesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ExamenesPreguntasMySqlDAO.class.php';

    $examenFacade = new ExamenFacade();

    $profesor = $_SESSION['usuario']['idusuario'];
    $fichasDAO = new FichasMySqlDAO();
    $cursosDAO = new CursosMySqlDAO();
    $estadosDAO = new EstadosExamenesMySqlDAO();
    $examenesDAO = new ExamenesMySqlDAO();
    $preguntasDAO = new PreguntasMySqlDAO();
    $examenesPreguntasDAO = new ExamenesPreguntasMySqlDAO();

    $cursos = $cursosDAO->listarTodos();
    $fichas = $fichasDAO->listarTodos();
    $estados = $estadosDAO->listarTodos();
    $preguntas = $preguntasDAO->listarTodos();

    $curso = "";
    $fechaInicial = "";
    $fechaFinal = "";
    $ficha = "";
    $estado = "";
    $tipoExamen = "";
    $preguntasSeleccionadas = "";
    $cantidadPreguntas = "";

    $boton = "";

    if (isset($_POST['boton'])) {
        $boton = (empty($_POST["boton"]) ? "" : $_POST["boton"]);
        $curso = (empty($_POST["curso"]) ? "" : $_POST["curso"]);
        $fechaInicial = (empty($_POST["fechaInicial"]) ? "" : $_POST["fechaInicial"]);
        $fechaFinal = (empty($_POST["fechaFinal"]) ? "" : $_POST["fechaFinal"]);
        $ficha = (empty($_POST["ficha"]) ? "" : $_POST["ficha"]);
        $estado = (empty($_POST["estado"]) ? "" : $_POST["estado"]);
        $tipoExamen = (empty($_POST["tipoExamen"]) ? "" : $_POST["tipoExamen"]);
    }

    if (strcmp($boton, "registrar-examen") == 0 && strcmp($tipoExamen, "manual") == 0) {
        $hoy = date("Y-m-d");
        $tmp = explode('-', $hoy);
        $fechaHoy = mktime(0, 0, 0, $tmp[0], $tmp[1] + 1, $tmp[2]);
        $strIni = explode('-', $fechaInicial);
        $fechaIni = mktime(0, 0, 0, $strIni[1], $strIni[2], $strIni[0]);
        $strFin = explode('-', $fechaFinal);
        $fechaFin = mktime(0, 0, 0, $strFin[1], $strFin[2], $strFin[0]);
        if (date("U" . $fechaHoy) > date("U", $fechaIni)) {
            echo "<script>swal(\"Atención\", \"La fecha inicial del examen debe ser superior a la fecha actual \", \"warning\");</script>";
        } else if (date("U", $fechaIni) > date("U", $fechaFin)) {
            echo "<script>swal(\"Atención\", \"La fecha limite del examen debe ser superior a la fecha inicial \", \"warning\");</script>";
        } else {
            $preguntasSeleccionadas = (empty($_POST["preguntasSeleccionadas"]) ? "" : $_POST["preguntasSeleccionadas"]);
            if (is_array($preguntasSeleccionadas) && count($preguntasSeleccionadas) > 0) {
                $examen = new Examen($curso, $profesor, $fechaInicial, $fechaFinal, $estado, $ficha);
                $examenFacade->crearExamenManual($examen, $preguntasSeleccionadas);
                $curso = "";
                $fechaInicial = "";
                $fechaFinal = "";
                $ficha = "";
                $estado = "";
            } else {
                echo "<script>swal(\"No ha seleccionado ninguna pregunta\", \"Por favor seleccione al menos una pregunta e intente nuevamente \", \"warning\");</script>";
            }
        }
    }

    if (strcmp($boton, "registrar-examen") == 0 && strcmp($tipoExamen, "automatico") == 0) {
        $hoy = date("Y-m-d");
        $tmp = explode('-', $hoy);
        $fechaHoy = mktime(0, 0, 0, $tmp[0], $tmp[1] + 1, $tmp[2]);
        $strIni = explode('-', $fechaInicial);
        $fechaIni = mktime(0, 0, 0, $strIni[1], $strIni[2], $strIni[0]);
        $strFin = explode('-', $fechaFinal);
        $fechaFin = mktime(0, 0, 0, $strFin[1], $strFin[2], $strFin[0]);
        if (date("U" . $fechaHoy) > date("U", $fechaIni)) {
            echo "<script>swal(\"Atención\", \"La fecha inicial del examen debe ser superior a la fecha actual \", \"warning\");</script>";
        } else if (date("U", $fechaIni) > date("U", $fechaFin)) {
            echo "<script>swal(\"Atención\", \"La fecha limite del examen debe ser superior a la fecha inicial \", \"warning\");</script>";
        } else {
            $cantidadPreguntas = (empty($_POST["cantidadPreguntas"]) ? "" : $_POST["cantidadPreguntas"]);
            if ($cantidadPreguntas > 0 && $cantidadPreguntas <= $preguntasDAO->contarPreguntasPorCurso($curso)) {
                $examen = new Examen($curso, $profesor, $fechaInicial, $fechaFinal, $estado, $ficha);
                $examenFacade->crearExamenAutomatico($examen, $cantidadPreguntas);
                $curso = "";
                $fechaInicial = "";
                $fechaFinal = "";
                $ficha = "";
                $estado = "";
            } else {
                echo "<script>swal(\"Ha seleccionado una cantidad de preguntas mayor a las disponibles \", \"warning\");</script>";
            }
        }
    }
    ?>
        <h4>Crear Examen</h4>
    <hr>
    <noscript>
    <p class="text-danger">
        Debe habilitar el JavaScript en su navegador!!!
    </p>
    </noscript>
    <form id="form_crear_examen" method="post" class="form-horizontal" 
          action="crear-examen.php">
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="curso">Nombre del curso:</label>
            <div class="col-sm-5">
                <select id="curso" name="curso" class="form-control" required="true">
                    <option value="" disabled selected>Seleccione un curso</option>
    <?php
    foreach ($cursos as $fila) {
        echo '<option value="' . $fila['idcurso'] . '">' . $fila['nombrecurso'] . '</option>';
    }
    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="fechaInicial">Fecha Inicial:</label>
            <div class="col-sm-5">
                <input type="date" id="fechaInicial" name="fechaInicial" 
                       placeholder="dd/mm/yyyy" class="form-control" 
                       value="<?= $fechaInicial; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="fechaFinal">Fecha Final:</label>
            <div class="col-sm-5">
                <input type="date" id="fechaFinal" name="fechaFinal" 
                       placeholder="dd/mm/yyyy" class="form-control" 
                       value="<?= $fechaFinal; ?>">
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="ficha">Ficha:</label>
            <div class="col-sm-5">
                <select id="ficha" name="ficha" class="form-control">
                    <option value="" disabled selected>Seleccione la ficha</option>
    <?php
    foreach ($fichas as $fila) {
        echo '<option value="' . $fila['ficha'] . '">' . $fila['ficha'] . '</option>';
    }
    ?>
                </select>
            </div>
        </div>  
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="estado">Estado:</label>
            <div class="col-sm-5">
                <select id="estado" name="estado" class="form-control">
                    <option value="" disabled selected>Seleccione el estado</option>
    <?php
    foreach ($estados as $fila) {
        echo '<option value="' . $fila['idestadoexamen'] . '">' . $fila['nombreestadoexamen'] . '</option>';
    }
    ?>
                </select>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="tipoExamen">Tipo de Examen:</label>
            <div class="col-sm-5">
                <select id="tipoExamen" name="tipoExamen" class="form-control" required="true">
                    <option value="" disabled selected>
                        Seleccione el tipo de examen
                    </option>
                    <option value="manual">Manual</option>
                    <option value="automatico">Automático</option>
                </select>
            </div>
        </div>
    <?php
    if (strcmp($boton, "continuar") == 0 && strcmp($tipoExamen, "manual") == 0) {
        $preguntasPorCurso = $preguntasDAO->buscarPreguntasPorCurso($curso);
        if ($preguntasDAO->contarPreguntasPorCurso($curso) > 0) {
            echo '<hr><div id="divPreguntas"><table border="1" class="table table-hover"><thead><tr><td></td><td>Enunciado</td></tr></thead><tbody>';
            foreach ($preguntasPorCurso as $p) {
                echo '<tr><td><input type="checkbox" name="preguntasSeleccionadas[]" value=' . $p['idpregunta'] . '></td><td>' . $p['enunciado'] . '</td>';
            }
            echo '</tbody></table></div>';
        }
    } else if (strcmp($boton, "continuar") == 0 && strcmp($tipoExamen, "automatico") == 0) {
        $preguntasPorCurso = $preguntasDAO->buscarPreguntasPorCurso($curso);
        $cant = $preguntasDAO->contarPreguntasPorCurso($curso);
        ?>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label" 
                       for="cantidadPreguntas">Cantidad de Preguntas:</label>
                <div class="col-sm-5">
                    <input type="number" id="cantidadPreguntas" name="cantidadPreguntas" 
                           class="form-control"
                           value="<?= $cantidadPreguntas; ?>">
                </div>
            </div>
        <?php
    }
    ?>
        <?php if (strcmp($boton, "continuar") == 0) { ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" 
                        id="atras" name="boton"
                        value="atras">Atras
                </button>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" 
                        id="registrar" name="boton"
                        value="registrar-examen">Registrar
                </button>
            </div>
        <?php
    } else {
        ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" 
                        id="continuar" name="boton"
                        value="continuar">Continuar
                </button>
            </div>
    <?php } ?>
    </form>
    <script type = "text/javascript">
        $().ready(function () {
            $('#curso').val('<?= empty($curso) ? '' : $curso ?>');
            $('#ficha').val('<?= empty($ficha) ? '' : $ficha ?>');
            $('#estado').val('<?= empty($estado) ? '' : $estado ?>');
            $('#tipoExamen').val('<?= empty($tipoExamen) ? '' : $tipoExamen ?>');
        });

        $('#continuar').click(function () {
            $('#form_crear_examen').formValidation({
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
                                message: 'Seleccione un curso'
                            }
                        }
                    },
                    fechaInicial: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'La fecha inicial es requerida'
                            },
                            regexp: {
                                regexp: /^([0][1-9]|[12][0-9]|3[01])(\/)([0][1-9]|[1][0-2])(\/)(19|20)\d{2}|(19|20)\d{2}(\-)([0][1-9]|[1][0-2])(\-)([0][1-9]|[12][0-9]|3[01])$/,
                                message: 'Por favor ingrese la fecha inicial en formato dd/mm/aaaa'
                            }
                        }
                    },
                    fechaFinal: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'La fecha final es requerida'
                            },
                            regexp: {
                                regexp: /^([0][1-9]|[12][0-9]|3[01])(\/)([0][1-9]|[1][0-2])(\/)(19|20)\d{2}|(19|20)\d{2}(\-)([0][1-9]|[1][0-2])(\-)([0][1-9]|[12][0-9]|3[01])$/,
                                message: 'Por favor ingrese la fecha final en formato dd/mm/aaaa'
                            }
                        }
                    },
                    ficha: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Seleccione una ficha'
                            }
                        }
                    },
                    estado: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un estado'
                            }
                        }
                    },
                    tipoExamen: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un tipo de examen'
                            }
                        }
                    }
                }
            });
        });

        $("#registrar").click(function () {
            $('#form_crear_examen').formValidation({
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
                                message: 'Seleccione un curso'
                            }
                        }
                    },
                    fechaInicial: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'La fecha inicial es requerida'
                            },
                            regexp: {
                                regexp: /^([0][1-9]|[12][0-9]|3[01])(\/)([0][1-9]|[1][0-2])(\/)(19|20)\d{2}|(19|20)\d{2}(\-)([0][1-9]|[1][0-2])(\-)([0][1-9]|[12][0-9]|3[01])$/,
                                message: 'Por favor ingrese la fecha inicial en formato dd/mm/aaaa'
                            }
                        }
                    },
                    fechaFinal: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'La fecha final es requerida'
                            },
                            regexp: {
                                regexp: /^([0][1-9]|[12][0-9]|3[01])(\/)([0][1-9]|[1][0-2])(\/)(19|20)\d{2}|(19|20)\d{2}(\-)([0][1-9]|[1][0-2])(\-)([0][1-9]|[12][0-9]|3[01])$/,
                                message: 'Por favor ingrese la fecha final en formato dd/mm/aaaa'
                            }
                        }
                    },
                    ficha: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Seleccione una ficha'
                            }
                        }
                    },
                    estado: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un estado'
                            }
                        }
                    },
                    tipoExamen: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un tipo de examen'
                            }
                        }
                    },
                    cantidadPreguntas: {
                        row: '.col-sm-5',
                        validators: {
                            notEmpty: {
                                message: 'Ingrese la cantidad de preguntas'
                            },
                            between: {
                                min: 1,
                                max: <?php echo empty($cant) ? 0 : $cant; ?>,
                                message: 'La cantidad debe ser mayor que 0 y menor o igual a <?php echo empty($cant) ? 0 : $cant; ?>'
                            }
                        }
                    }
                }
            });
            document.getElementById("curso").required = true;
            document.getElementById("fechaInicial").required = true;
            document.getElementById("fechaFinal").required = true;
            document.getElementById("ficha").required = true;
            document.getElementById("estado").required = true;
            document.getElementById("tipoExamen").required = true;
            document.getElementById("cantidadPreguntas").required = true;
        });
        $("#atras").click(function () {
            document.getElementById("curso").required = false;
            document.getElementById("fechaInicial").required = false;
            document.getElementById("fechaFinal").required = false;
            document.getElementById("ficha").required = false;
            document.getElementById("estado").required = false;
            document.getElementById("tipoExamen").required = false;
        });
    </script>
    <?php
    include ("footer.php");
} else {
    echo 'Acceso denegado, por favor inicie sesión';
}
?>
        