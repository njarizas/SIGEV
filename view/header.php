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
            <div class="col-sm-8 col-sm-offset-2" style="background-color:#FFF;">
                <header> 
                    <img class="img-responsive pull-left" src="img/SIGEV.png" height="100" width="100">
                    <h2>SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE EXAMENES VIRTUALES.</h2><hr>
                    <?php
                    session_start();
                    if (!empty($_SESSION['usuario'])) {
                        if ($_SESSION['usuario']['rol'] == 1) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <ul class="nav navbar-nav">
                                    <li><a href="#">Contestar Examen</a></li>
                                    <li><a href="#">Ver Resultados de Examenes</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                    <li><a href="cerrar-sesion.php">Cerrar Sesion</a></li>
                                </ul>
                            </nav>
                            <?php
                        } else if ($_SESSION['usuario']['rol'] == 2) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <ul class="nav navbar-nav">
                                    <li><a href="crear-preguntas.php">Crear Preguntas</a></li>
                                    <li><a href="crear-examen.php">Crear Examen</a></li>
                                    <li><a href="#">Ver Resultados de Examenes</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                    <li><a href="cerrar-sesion.php">Cerrar Sesion</a></li>
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
                                    <li><a href="cerrar-sesion.php">Cerrar Sesion</a></li>
                                </ul>
                            </nav>
                            <?php
                        }
                    }
                    ?>
                </header>
            