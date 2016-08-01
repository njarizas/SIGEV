<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Crear Curso</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/formValidation.min.css"> <!-- NEW!!! -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formValidation.min.js"></script> <!-- NEW!!! -->
        <script src="js/bootstrap.js"></script> <!-- NEW!!! -->
        <script src="js/es_ES.js"></script> <!-- NEW!!! -->

    </head>
    <body>
        <div class="container" style="background-color:#EEE;">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2" style="background-color:#FFF;">
                    <?php
                    include ("header.php");
                    require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
                    $cursosDAO = new CursosMySqlDAO();
                    if (isset($_POST['registrar-curso'])) {
                        $nombreCurso = ($_POST["nombreCurso"]);
                        if ($cursosDAO->insertar($nombreCurso) > 0) {
                            echo "<script>alert('El curso \"" . $nombreCurso . "\" se agrego exitosamente');</script>";
                        }
                    }
                    $nombreCurso = "";
                    ?>
                    <div class="page-header">
                        <h2>Crear Cursos</h2>
                    </div>

                    <noscript>
                    <p class="text-danger">
                        Debe habilitar el JavaScript en su navegador!!!
                    </p>
                    </noscript>
                    <form id="form_registrar_curso" method="post" class="form-horizontal" action="crear-curso.php">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="nombreCurso">Nombre del Curso:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" placeholder="Ej: Matemáticas" value="<?= $nombreCurso; ?>" maxlength="45" required>
                            </div>
                        </div>
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary" name="registrar-curso" value="registrar-curso">Crear Curso</button>
                        </div>

                    </form>
                    <br>
                    <hr>
                    <br>
                    <?php
                    $cursos = $cursosDAO->listarCursos();
                    if (count($cursos) > 0) {
                        echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"><table border="1" class="table table-hover"><tr><td>Id Doc</td><td>Documento</td></tr>';
                    }
                    foreach ($cursos as $fila) {
                        echo '<tr><td>' . $fila['idcurso'] . '</td>';
                        echo '<td>' . $fila['nombrecurso'] . '</td></tr>';
                    }
                    echo '</table></div></div>';
                    include ("footer.php");
                    ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $().ready(function () {
                $('#form_registrar_curso').formValidation({
                    message: 'Este valor no es correcto',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        nombreCurso: {
                            row: '.col-sm-5',
                            validators: {
                                notEmpty: {
                                    message: 'El Nombre del curso es obligatorio'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 45,
                                    message: 'El nombre del curso debe contener entre 6 y 45 caracteres'
                                }
                            }
                        }
                    }
                });
            });
        </script>

    </body>
</html>