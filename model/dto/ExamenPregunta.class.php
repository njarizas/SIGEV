<?php

/**
 * Object represents table 'examenespreguntas'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class ExamenPregunta {

    private $idExamen;
    private $idPregunta;

    function __construct($idExamen, $idPregunta) {
        $this->idExamen = $idExamen;
        $this->idPregunta = $idPregunta;
    }

    function getIdExamen() {
        return $this->idExamen;
    }

    function getIdPregunta() {
        return $this->idPregunta;
    }

    function setIdExamen($idExamen) {
        $this->idExamen = $idExamen;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

}
