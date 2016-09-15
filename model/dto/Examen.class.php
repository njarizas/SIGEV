<?php

/**
 * Object represents table 'examenes'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Examen {

    private $idExamen;
    private $idCurso;
    private $idProfesor;
    private $fechaInicio;
    private $fechaFin;
    private $idEstadoExamen;
    private $ficha;

    function __construct($idCurso, $idProfesor, $fechaInicio, $fechaFin, $idEstadoExamen, $ficha) {
        $this->idCurso = $idCurso;
        $this->idProfesor = $idProfesor;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->idEstadoExamen = $idEstadoExamen;
        $this->ficha = $ficha;
    }

    function getIdExamen() {
        return $this->idExamen;
    }

    function getIdCurso() {
        return $this->idCurso;
    }

    function getIdProfesor() {
        return $this->idProfesor;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getIdEstadoExamen() {
        return $this->idEstadoExamen;
    }

    function setIdExamen($idExamen) {
        $this->idExamen = $idExamen;
    }

    function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }

    function setIdProfesor($idProfesor) {
        $this->idProfesor = $idProfesor;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setIdEstadoExamen($idEstadoExamen) {
        $this->idEstadoExamen = $idEstadoExamen;
    }

    function getFicha() {
        return $this->ficha;
    }

    function setFicha($ficha) {
        $this->ficha = $ficha;
    }

}
