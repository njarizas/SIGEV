<?php

/**
 * Object represents table 'preguntas'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Pregunta {

    private $idPregunta;
    private $enunciado;
    private $valorPregunta;
    private $idCurso;

    function __construct($enunciado, $valorPregunta, $idCurso) {
        $this->enunciado = $enunciado;
        $this->valorPregunta = $valorPregunta;
        $this->idCurso = $idCurso;
    }

    function getIdPregunta() {
        return $this->idPregunta;
    }

    function getEnunciado() {
        return $this->enunciado;
    }

    function getValorPregunta() {
        return $this->valorPregunta;
    }

    function getIdCurso() {
        return $this->idCurso;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

    function setEnunciado($enunciado) {
        $this->enunciado = $enunciado;
    }

    function setValorPregunta($valorPregunta) {
        $this->valorPregunta = $valorPregunta;
    }

    function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }

}

?>