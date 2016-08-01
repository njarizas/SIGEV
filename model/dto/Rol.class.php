<?php

/**
 * Object represents table 'roles'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Rol {

    private $idRol;
    private $nombreRol;

    function __construct($nombreRol) {
        $this->nombreRol = $nombreRol;
    }

    function getIdRol() {
        return $this->idRol;
    }

    function getNombreRol() {
        return $this->nombreRol;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    function setNombreRol($nombreRol) {
        $this->nombreRol = $nombreRol;
    }

}

?>