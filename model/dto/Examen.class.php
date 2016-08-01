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
    private $horaInicio;
    private $fechaFin;
    private $horaFin;
    private $idEstadoExamen;

    function __construct($idCurso, $idProfesor, $fechaInicio, $horaInicio, $fechaFin, $horaFin, $idEstadoExamen) {
        $this->idCurso = $idCurso;
        $this->idProfesor = $idProfesor;
        $this->fechaInicio = $fechaInicio;
        $this->horaInicio = $horaInicio;
        $this->fechaFin = $fechaFin;
        $this->horaFin = $horaFin;
        $this->idEstadoExamen = $idEstadoExamen;
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

    function getHoraInicio() {
        return $this->horaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getHoraFin() {
        return $this->horaFin;
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

    function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setHoraFin($horaFin) {
        $this->horaFin = $horaFin;
    }

    function setIdEstadoExamen($idEstadoExamen) {
        $this->idEstadoExamen = $idEstadoExamen;
    }

}

?>