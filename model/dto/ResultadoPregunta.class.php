<?php

/**
 * Object represents table 'resultadospreguntas'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class ResultadoPregunta {

    private $idResultadoPregunta;
    private $idResultadoExamen;
    private $idRespuesta;
    private $idPregunta;

    function __construct($idResultadoExamen, $idPregunta, $idRespuesta) {
        $this->idResultadoExamen = $idResultadoExamen;
        $this->idPregunta = $idPregunta;
        $this->idRespuesta = $idRespuesta;
    }

    function getIdResultadoPregunta() {
        return $this->idResultadoPregunta;
    }

    function getIdResultadoExamen() {
        return $this->idResultadoExamen;
    }

    function getIdRespuesta() {
        return $this->idRespuesta;
    }

    function getIdPregunta() {
        return $this->idPregunta;
    }

    function setIdResultadoPregunta($idResultadoPregunta) {
        $this->idResultadoPregunta = $idResultadoPregunta;
    }

    function setIdResultadoExamen($idResultadoExamen) {
        $this->idResultadoExamen = $idResultadoExamen;
    }

    function setIdRespuesta($idRespuesta) {
        $this->idRespuesta = $idRespuesta;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

}
