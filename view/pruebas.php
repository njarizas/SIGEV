<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pruebas</title>
    </head>
    <body>
        <?php
        require_once '../model/dao/implementacion/PreguntasMySqlDAO.class.php';
        require_once '../controller/ExamenFacade.php';
        require_once '../model/dto/Examen.class.php';
        $preguntasDAO = new PreguntasMySqlDAO;
        //echo $preguntasDAO->contarPreguntasPorCurso(14);

        $examenFacade = new ExamenFacade();
        $r = $examenFacade->listarTodasLasPreguntasPorIdCurso(14);
        echo 'la cantidad de preguntas es ' . count($r) . '<br>';
        foreach ($r as $fila) {
            echo $fila->getIdPregunta() . '-' . $fila->getEnunciado() . '-' . $fila->getValorPregunta() . '-' . $fila->getIdCurso() . '<br>';
        }
        echo '<hr>';
        $examenFacade->generarIndicesPreguntas(2, 14);
        $listaPreguntasGen = $examenFacade->seleccionarPreguntasAutomaticamente(new Examen(14, 1, time(), time(), 1, 1), 1);
        foreach ($listaPreguntasGen as $preg) {
            echo $preg->getEnunciado().'<br>';
        }
        ?>
    </body>
</html>
