<?php

/**
 * Description of ExamenFacade
 *
 * @author Nelson
 */
require_once '../model/dto/Pregunta.class.php';

class ExamenFacade {

    function __construct() {
        $this->preguntasDAO = new PreguntasMySqlDAO();
        $this->examenesDAO = new ExamenesMySqlDAO();
        $this->examenesPreguntasDAO = new ExamenesPreguntasMySqlDAO();
    }

    private $preguntasDAO;
    private $examenesDAO;
    private $examenesPreguntasDAO;

    /**
     * Este metodo retorna un array con $cantidadPreguntas preguntas 
     * seleccionadas aleatoriamente para poder generar un examen automático
     * @param int $idCurso el idCurso del curso del examen que se quiere generar automáticamente
     * @param int $cantidadPreguntas la cantidad de preguntas que se quieren generar automáticamente
     * @return Pregunta[] arreglo con las preguntas seleccionadas automáticamente
     */
    public function seleccionarPreguntasAutomaticamente($idCurso, $cantidadPreguntas) {
        if ($this->preguntasDAO->contarPreguntasPorCurso($idCurso) >= $cantidadPreguntas) {
            $listaTotalPreguntas = $this->listarTodasLasPreguntasPorIdCurso($idCurso);
            $listaPreguntasGeneradas = array();
            $listaDeIndices = $this->generarIndicesPreguntas($cantidadPreguntas, $idCurso);
            foreach ($listaDeIndices as $indice) {
                $listaPreguntasGeneradas[] = $listaTotalPreguntas[$indice];
//                echo 'Generó pregunta: ' . $listaTotalPreguntas[$indice]->getEnunciado().'<br>';
            }
            echo "<script>swal(\"Atención\", \"Acá debe generar un examen aleatorio"
            . " de " . $cantidadPreguntas . " preguntas.\", \"info\");</script>";
            return $listaPreguntasGeneradas;
        } else {
            echo "<script>swal(\"Atención\", \"No puede generar este examen porque"
            . " la cantidad de preguntas del examen es superior a la cantidad de"
            . " preguntas existentes\", \"error\");</script>";
            die('La cantidad de preguntas seleccionadas es superior a la cantidad de preguntas existentes');
            return null;
        }
    }

    /**
     * Este método retorna un array con todas las preguntas asociadas al curso
     * cuyo id es igual al que se recibe como parametro
     * @param int $idCurso Es el id del curso del cual se quieren listar todas 
     * sus preguntas
     * @return Pregunta[] lista de preguntas que corresponden al curso con id $idCurso
     */
    public function listarTodasLasPreguntasPorIdCurso($idCurso) {
        $listaPreguntas = array();
        if ($this->preguntasDAO->contarPreguntasPorCurso($idCurso) > 0) {
            $resultSet = $this->preguntasDAO->buscarPreguntasPorCurso($idCurso);
            foreach ($resultSet as $fila) {
                $pregunta = new Pregunta($fila['enunciado'], $fila['valorpregunta'], $fila['idcurso']);
                $pregunta->setIdPregunta($fila['idpregunta']);
                $listaPreguntas[] = $pregunta;
            }
            return $listaPreguntas;
        }
        return null;
    }

    /**
     * Este metodo genera un Array de enteros de tamaño $cantidad que serán los 
     * indices de las preguntas seleccionadas del examen automático
     * @param type $cantidad La cantidad de preguntas que debe seleccionar
     * @param type $idCurso El Id del curso para el cual se va a crear e examen
     * esto para saber el límite máximo que deben tener los numeros generados ya
     * que ellos serán indices en un arreglo
     * @return int[] Retorna un arreglo de enteros de tamaño $cantidad que 
     * contendrá el indice de las preguntas seleccionadas de acuerdo al curso
     */
    public function generarIndicesPreguntas($cantidad, $idCurso) {
        $totalPreguntas = $this->preguntasDAO->contarPreguntasPorCurso($idCurso);
        if ($totalPreguntas >= $cantidad) {
            //aca debe generar $cantidad de numeros aleatorios
            //que sean >=0 y <$totalPreguntas estrictamente menor debido a
            //que estos serán los indices de las preguntas aleatorias seleccionadas 
            //para el examen automático
            $listaIndices = array();
            while (count($listaIndices) < $cantidad) {
                $num = rand(0, $totalPreguntas - 1);
                if (!in_array($num, $listaIndices)) {
                    $listaIndices[] = $num;
//                    echo 'Generó: ' . $num . '<br>';
                }
            }
            return $listaIndices;
        } else {
            echo "<script>swal(\"Atención\", \"No puede generar los indices de"
            . " las preguntas porque la cantidad de preguntas del examen es"
            . " superior a la cantidad de preguntas existentes\",\"error\");"
            . "</script>";
            return null;
        }
    }

    public function crearExamenAutomatico($examen, $cantidadPreguntas) {
        if ($this->examenesDAO->insertar($examen) > 0) {
            $idExamen = $this->examenesDAO->obtenerUltimoRegistroInsertado()['idexamen'];
            $preguntasSeleccionadas = $this->seleccionarPreguntasAutomaticamente($examen->getIdCurso(), $cantidadPreguntas);
            foreach ($preguntasSeleccionadas as $pregunta) {
                $this->examenesPreguntasDAO->insertar(new ExamenPregunta($idExamen, $pregunta->getIdPregunta()));
            }
//            echo 'Creo examen automatico con ' . $cantidadPreguntas . ' preguntas';
            echo "<script>swal(\"Registro exitóso\", \"El examen asignado a la ficha " . $examen->getFicha() . " que consta de " . count($preguntasSeleccionadas) . " preguntas fue registrado exitósamente \", \"success\");</script>";
        } else {
            echo "<script>swal(\"Error\", \"Ocurrió un error por favor comuníquese"
            . " con el administrador \", \"error\");</script>";
        }
    }

    public function crearExamenManual($examen, $preguntasSeleccionadas) {
        if ($this->examenesDAO->insertar($examen) > 0) {
            $idExamen = $this->examenesDAO->obtenerUltimoRegistroInsertado()['idexamen'];
            foreach ($preguntasSeleccionadas as $idPregunta) {
                $this->examenesPreguntasDAO->insertar(new ExamenPregunta($idExamen, $idPregunta));
            }
            echo 'Creo examen manual con ' . count($preguntasSeleccionadas) . ' preguntas';
            echo "<script>swal(\"Registro exitóso\", \"El examen asignado a la"
            . " ficha " . $examen->getFicha() . " que consta de "
            . count($preguntasSeleccionadas) . " preguntas fue registrado"
            . " exitósamente \", \"success\");</script>";
        } else {
            echo "<script>swal(\"Error\", \"Ocurrió un error por favor comuníquese"
            . " con el administrador \", \"error\");</script>";
        }
    }

}
