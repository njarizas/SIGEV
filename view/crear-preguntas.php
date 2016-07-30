 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <title>Crear Preguntas</title>
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
                    require_once '../class/mysql/CursosMySqlDAO.class.php';
 $cursosDAO = new CursosMySqlDAO();
 $cursos=$cursosDAO->listarCursos();
                    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="page-header">
                    <h2>Crear Preguntas</h2>
                </div>

                <noscript>
                    <p class="text-danger">
                        Debe habilitar el JavaScript en su navegador!!!
                    </p>
                </noscript>

                <form id="form_registrar_pregunta" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="curso">Nombre del curso:</label>
                        <div class="col-sm-5">
                            <select id="curso" name="curso" class="form-control">
                              <option value="" disabled selected>Seleccione un curso</option>
                              <?php
                              foreach ($cursos as $fila) {
                                echo '<option value="' . $fila['idcurso'] . '">'. $fila['nombrecurso'] .'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="enunciado">Enunciado de la pregunta:</label>
                        <div class="col-sm-5">
                            <input type="textarea" class="form-control" id="enunciado" name="enunciado" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="RespuestaCorrecta">Respuesta correcta:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="RespuestaCorrecta" name="RespuestaCorrecta" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="respuestaErronea1">Respuesta erronea 1:</label>
                        <div class="col-sm-5"> 
                            <input type="text" class="form-control" id="respuestaErronea1" name="respuestaErronea1" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="respuestaErronea2">Respuesta erronea 2:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="respuestaErronea2" name="respuestaErronea2" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="respuestaErronea3">Respuesta erronea 3:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="respuestaErronea3" name="respuestaErronea3" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="respuestaErronea4">Respuesta erronea 4:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="respuestaErronea4" name="respuestaErronea4" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary" name="registrar" value="registrar">Crear Pregunta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <?php include ("footer.php");
        ?>
                </div>
            </div>
        </div>
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
                    curso:{
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

</body>
</html>