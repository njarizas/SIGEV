<?php

/**
 * Object represents table 'estadosexamenes'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class EstadoExamen {

    private $idEstadosExamen;
    private $nombreEstadoExamen;

    function __construct($nombreEstadoExamen) {
        $this->nombreEstadoExamen = $nombreEstadoExamen;
    }

    function getIdEstadosExamen() {
        return $this->idEstadosExamen;
    }

    function getNombreEstadoExamen() {
        return $this->nombreEstadoExamen;
    }

    function setIdEstadosExamen($idEstadosExamen) {
        $this->idEstadosExamen = $idEstadosExamen;
    }

    function setNombreEstadoExamen($nombreEstadoExamen) {
        $this->nombreEstadoExamen = $nombreEstadoExamen;
    }

}

?>