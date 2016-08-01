<?php

/**
 * Object represents table 'cursos'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Curso {

    private $idCurso;
    private $nombreCurso;

    function __construct($nombreCurso) {
        $this->nombreCurso = $nombreCurso;
    }

    function getIdCurso() {
        return $this->idCurso;
    }

    function getNombreCurso() {
        return $this->nombreCurso;
    }

    function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }

    function setNombreCurso($nombreCurso) {
        $this->nombreCurso = $nombreCurso;
    }

}

?>