<?php

/**
 * Object represents table 'respuestas'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Respuesta {

    private $idRespuesta;
    private $idPregunta;
    private $respuesta;

    function __construct($idPregunta, $respuesta) {
        $this->idPregunta = $idPregunta;
        $this->respuesta = $respuesta;
    }

    function getIdRespuesta() {
        return $this->idRespuesta;
    }

    function getIdPregunta() {
        return $this->idPregunta;
    }

    function getRespuesta() {
        return $this->respuesta;
    }

    function setIdRespuesta($idRespuesta) {
        $this->idRespuesta = $idRespuesta;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

    function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

}
