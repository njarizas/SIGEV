<?php

/**
 * Object represents table 'tiposdocumentos'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class TipoDocumento {

    private $idTipoDocumento;
    private $nombreDocumento;

    function __construct($nombreDocumento) {
        $this->nombreDocumento = $nombreDocumento;
    }

    function getIdTipoDocumento() {
        return $this->idTipoDocumento;
    }

    function getNombreDocumento() {
        return $this->nombreDocumento;
    }

    function setIdTipoDocumento($idTipoDocumento) {
        $this->idTipoDocumento = $idTipoDocumento;
    }

    function setNombreDocumento($nombreDocumento) {
        $this->nombreDocumento = $nombreDocumento;
    }

}

?>