<?php
include ("header.php");
if (!empty($_SESSION['usuario'])) {
    require_once '../model/dto/Usuario.class.php';
    require_once '../model/dto/Examen.class.php';
    require_once '../model/dto/ExamenPregunta.class.php';
    require_once '../model/dao/implementacion/UsuariosMySqlDAO.class.php';
    require_once '../model/dao/implementacion/TiposDocumentoMySqlDAO.class.php';
    require_once '../model/dao/implementacion/RolesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/FichasMySqlDAO.class.php';
    require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
    require_once '../model/dao/implementacion/EstadosExamenesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ExamenesMySqlDAO.class.php';
    require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
    require_once '../model/dao/implementacion/ExamenesPreguntasMySqlDAO.class.php';

    $profesor = $_SESSION['usuario']['idusuario'];
    $usuarioDAO = new UsuariosMySqlDAO();
    $tipoDocDAO = new TiposDocumentoMySqlDAO();
    $rolesDAO = new RolesMySqlDAO();
    $fichasDAO = new FichasMySqlDAO();
    $cursosDAO = new CursosMySqlDAO();
    $estadosDAO = new EstadosExamenesMySqlDAO();
    $examenesDAO = new ExamenesMySqlDAO();
    $preguntasDAO = new PreguntasMySqlDAO();
    $examenesPreguntasDAO = new ExamenesPreguntasMySqlDAO();
    $tipoDoc = $tipoDocDAO->listarTodos();
    $roles = $rolesDAO->listarTodos();
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

    $boton = "";

    if (isset($_POST['boton'])) {
        $boton = ($_POST["boton"]);
        $curso = ($_POST["curso"]);
        $fechaInicial = ($_POST["fechaInicial"]);
        $fechaFinal = ($_POST["fechaFinal"]);
        $ficha = ($_POST["ficha"]);
        $estado = ($_POST["estado"]);
        $tipoExamen = ($_POST["tipoExamen"]);
    }
    if (strcmp($boton, "registrar-examen") == 0) {
        if ($examenesDAO->insertar(new Examen($curso, $profesor, $fechaInicial, $fechaFinal, $estado, $ficha)) > 0) {
            $idExamenes = $examenesDAO->obtenerUltimoRegistroInsertado();
            foreach ($idExamenes as $id) {
                $idExamen = $id['idexamen'];
            }
            foreach ($_POST['preguntas'] as $idPregunta) {
                $examenesPreguntasDAO->insertar(new ExamenPregunta($idExamen, $idPregunta));
            }
            echo "<script>swal(\"Registro exitóso\", \"El examen asignado a la ficha " . $ficha . " fue registrado exitósamente \", \"success\");</script>";
            $curso = "";
            $fechaInicial = "";
            $fechaFinal = "";
            $ficha = "";
            $estado = "";
        }
    }
    ?>
    <div class="page-header">
        <h2>Crear Examen</h2>
    </div>
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
                <select id="curso" name="curso" class="form-control"
                        required="true">
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
                       value="<?= $fechaInicial; ?>" required="true">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="fechaFinal">Fecha Final:</label>
            <div class="col-sm-5">
                <input type="date" id="fechaFinal" name="fechaFinal" 
                       placeholder="dd/mm/yyyy" class="form-control" 
                       value="<?= $fechaFinal; ?>" required="true">
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label" 
                   for="ficha">Ficha:</label>
            <div class="col-sm-5">
                <select id="ficha" name="ficha" class="form-control" required="true">
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
                <select id="estado" name="estado" class="form-control" required="true">
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
            echo '<div id="divPreguntas"><table border="1" class="table table-hover"><thead><tr><td></td><td>Enunciado</td></tr></thead><tbody>';
            $preguntasPorCurso = $preguntasDAO->buscarPreguntasPorCurso($curso);
            foreach ($preguntasPorCurso as $p) {
                echo '<tr><td><input type="checkbox" name="preguntas[]" value=' . $p['idpregunta'] . '></td><td>' . $p['enunciado'] . '</td>';
            }
            echo '</tbody></table></div>';
        } else if (strcmp($boton, "continuar") == 0 && strcmp($tipoExamen, "automatico") == 0) {
            ?>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label" 
                       for="cantidadPreguntas">Cantidad de Preguntas:</label>
                <div class="col-sm-5">
                    <input type="text" id="cantidadPreguntas" name="cantidadPreguntas" 
                           class="form-control" 
                           value="" required="true">
                </div>
            </div>
            <?php
        }
        ?>
        <hr>
        <?php if (strcmp($boton, "continuar") != 0) { ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" 
                        name="boton"
                        value="continuar">Continuar
                </button></div>
        <?php } else {
            ?>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" 
                        name="boton"
                        value="registrar-examen">Registrar
                </button>
            </div>
        <?php } ?>
    </form>
    <br>
    <script type = "text/javascript">
        $().ready(function () {
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
                }
            });
            $('#curso').val('<?= empty($curso) ? '' : $curso ?>');
            $('#ficha').val('<?= empty($ficha) ? '' : $ficha ?>');
            $('#estado').val('<?= empty($estado) ? '' : $estado ?>');
            $('#tipoExamen').val('<?= empty($tipoExamen) ? '' : $tipoExamen ?>');
        });
    </script>
    <?php
    include ("footer.php");
} else {
    echo 'Acceso denegado, por favor inicie sesión';
}
?>
        