<?php

/**
 * Object represents table 'permisos'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Permiso {

    private $idPermiso;
    private $nombrePermiso;

    function __construct($nombrePermiso) {
        $this->nombrePermiso = $nombrePermiso;
    }

    function getIdPermiso() {
        return $this->idPermiso;
    }

    function getNombrePermiso() {
        return $this->nombrePermiso;
    }

    function setIdPermiso($idPermiso) {
        $this->idPermiso = $idPermiso;
    }

    function setNombrePermiso($nombrePermiso) {
        $this->nombrePermiso = $nombrePermiso;
    }

}

?>