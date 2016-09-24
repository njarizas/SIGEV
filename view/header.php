<!DOCTYPE html>
<html lang="es" style="height:100%;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width" />
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
    <body style="height:100%;">
        <div class="container" style="background-color:#EEE; min-height: 100%;">
            <div class="col-md-10 col-md-offset-1" style="background-color:#FFF; min-height: 95%;">
                <header> 
                    <img class="img-responsive pull-left" src="img/SIGEV.png" height="60" width="60">
                    <h3>SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE EXAMENES VIRTUALES.</h3>
                    <?php
                    session_start();
                    if (!empty($_SESSION['usuario'])) {
                        if ($_SESSION['usuario']['rol'] == 1) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle"
                                            data-toggle="collapse"
                                            data-target="#bs-example-navbar-collapse-1" >
                                        <span class="sr-only">Toggle navigation</span> 
                                        <span class="icon-bar"></span> 
                                        <span class="icon-bar"></span> 
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#" >Sigev</a>
                                </div>
                                <div class="collapse navbar-collapse"
                                     id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li><a href="resolver-examenes.php">Resolver Examenes</a></li>
                                        <li><a href="#">Ver Resultados de Examenes</a></li>
                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                        <li><a href="cerrar-sesion.php"><span class="glyphicon glyphicon-off" style="margin-right:15px;"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                            <?php
                        } else if ($_SESSION['usuario']['rol'] == 2) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle"
                                            data-toggle="collapse"
                                            data-target="#bs-example-navbar-collapse-1" >
                                        <span class="sr-only">Toggle navigation</span> 
                                        <span class="icon-bar"></span> 
                                        <span class="icon-bar"></span> 
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#" >Sigev</a>
                                </div>
                                <div class="collapse navbar-collapse"
                                     id="bs-example-navbar-collapse-1">
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
                                </div>
                            </nav>
                            <?php
                        } else if ($_SESSION['usuario']['rol'] == 3) {
                            ?>
                            <nav class="navbar navbar-default menu">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle"
                                            data-toggle="collapse"
                                            data-target="#bs-example-navbar-collapse-1" >
                                        <span class="sr-only">Toggle navigation</span> 
                                        <span class="icon-bar"></span> 
                                        <span class="icon-bar"></span> 
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#" >Sigev</a>
                                </div>
                                <div class="collapse navbar-collapse"
                                     id="bs-example-navbar-collapse-1">
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
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="registrar-usuario.php">Registrar Usuario</a></li>
                                                <li><a href="ver-usuarios.php">Ver Usuarios</a></li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="#"><?php echo $_SESSION['usuario']['nombres']; ?></a></li>
                                        <li><a href="cerrar-sesion.php"><span class="glyphicon glyphicon-off" style="margin-right:15px;"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                            <?php
                        }
                    }
                    ?>
                </header>
