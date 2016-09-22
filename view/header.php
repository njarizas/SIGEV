<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>SIGEV</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/formValidation.min.css"> <!-- NEW!!! -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formValidation.min.js"></script> <!-- NEW!!! -->
        <script src="js/bootstrap.js"></script> <!-- NEW!!! -->
        <script src="js/es_ES.js"></script> <!-- NEW!!! -->
        <!-- This is what you need -->
        <script src="js/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
        <!--.......................-->
    </head>
    <body>
        <div class="container" style="background-color:#EEE;">
            <div class="col-md-10 col-md-offset-1" style="background-color:#FFF;">
                <header> 
                    <img class="img-responsive pull-left" src="img/SIGEV.png" height="60" width="60">
                    <h3>SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE EXAMENES VIRTUALES.</h3>
                    <?php
                    session_start();
                    if (!empty($_SESSION['usuario'])) {
                        if ($_SESSION['usuario']['rol'] == 1) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <ul class="nav navbar-nav">
                                    <li><a href="resolver-examenes.php">Resolver Examenes</a></li>
                                    <li><a href="#">Ver Resultados de Examenes</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                    <li><a href="cerrar-sesion.php"><span class="glyphicon glyphicon-off" style="margin-right:15px;"></span></a></li>
                                </ul>
                            </nav>
                            <?php
                        } else if ($_SESSION['usuario']['rol'] == 2) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preguntas <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                             <li><a href="crear-preguntas.php">Crear Preguntas</a></li>
                                             <li><a href="ver-preguntas.php">Ver Preguntas</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Examenes <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                             <li><a href="crear-examen.php">Crear Examen</a></li>
                                             <li><a href="ver-examenes.php">Ver Examenes</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Ver Resultados de Examenes</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                    <li><a href="cerrar-sesion.php"><span class="glyphicon glyphicon-off" style="margin-right:15px;"></span></a></li>
                                </ul>
                            </nav>
                            <?php
                        } else if ($_SESSION['usuario']['rol'] == 3) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Parametrizacion <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="crear-curso.php">Crear Curso</a></li>
                                            <li><a href="crear-estado-examen.php">Crear Estado Examen</a></li>
                                            <li><a href="crear-ficha.php">Crear Ficha</a></li>
                                            <li><a href="crear-rol.php">Crear Rol</a></li>
                                            <li><a href="crear-tipo-documento.php">Crear Tipo Documento</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="registrar-usuario.php">Registrar Usuarios</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                    <li><a href="cerrar-sesion.php"><span class="glyphicon glyphicon-off" style="margin-right:15px;"></span></a></li>
                                </ul>
                            </nav>
                            <?php
                        }
                    }
                    ?>
                </header>
            