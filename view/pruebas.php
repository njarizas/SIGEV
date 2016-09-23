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
        require_once '../model/dao/implementacion/CursosMySqlDAO.class.php';
        require_once '../controller/ExamenFacade.php';
        require_once '../model/dto/Examen.class.php';
        $preguntasDAO = new PreguntasMySqlDAO;
        $cursosDAO = new CursosMySqlDAO();
        //echo $preguntasDAO->contarPreguntasPorCurso(14);

        $examenFacade = new ExamenFacade();
        $r = $examenFacade->listarTodasLasPreguntasPorIdCurso(14);
        echo 'la cantidad de preguntas es ' . $preguntasDAO->contarPreguntasPorCurso(14) . '<br>';
        foreach ($r as $fila) {
            echo $fila->getIdPregunta() . '-' . $fila->getEnunciado() . '-' . $fila->getValorPregunta() . '-' . $fila->getIdCurso() . '<br>';
        }
        echo '<hr>';
        $examenFacade->generarIndicesPreguntas(2, 14);
        $listaPreguntasGen = $examenFacade->seleccionarPreguntasAutomaticamente(13, 2);
        foreach ($listaPreguntasGen as $preg) {
            echo $preg->getEnunciado().'<br>';
        }
        for ($i=0;$i<10;$i++){
        echo 'existe curso'.$i.'?'. $cursosDAO->existeCursoConCodigo($i).'<br>';
        }
        echo (String)$cursosDAO->existeCursoConCodigo("MAT");
        ?>
    </body>
</html>
