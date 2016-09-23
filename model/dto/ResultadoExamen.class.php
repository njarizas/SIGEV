<?php

/**
 * Object represents table 'resultadosexamenes'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class ResultadoExamen {

    private $idResultadoExamen;
    private $idEstudiante;
    private $idExamen;
    private $nota;

    function __construct($idEstudiante, $idExamen, $nota) {
        $this->idEstudiante = $idEstudiante;
        $this->idExamen = $idExamen;
        $this->nota = $nota;
    }

    function getIdResultadoExamen() {
        return $this->idResultadoExamen;
    }

    function getIdEstudiante() {
        return $this->idEstudiante;
    }

    function getIdExamen() {
        return $this->idExamen;
    }

    function getNota() {
        return $this->nota;
    }

    function setIdResultadoExamen($idResultadoExamen) {
        $this->idResultadosExamenes = $idResultadoExamen;
    }

    function setIdEstudiante($idEstudiante) {
        $this->idEstudiante = $idEstudiante;
    }

    function setIdExamen($idExamen) {
        $this->idExamen = $idExamen;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }

}
