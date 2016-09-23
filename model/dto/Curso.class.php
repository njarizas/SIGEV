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
    private $codigoCurso;

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
    
    function getCodigoCurso() {
        return $this->codigoCurso;
    }

    function setCodigoCurso($codigoCurso) {
        $this->codigoCurso = $codigoCurso;
    }

}
