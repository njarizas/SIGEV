<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoDocumentoDaoImplementacion
 *
 * @author Nelson
 */
require_once 'class/config/Database.class.php';
require_once 'TipoDocumentoDaoInterface.php';
class TipoDocumentoDaoImplementacion implements TipoDocumentoDaoInterface{
    
    private $conn;
    
    function __construct() {
        $this->conn= Database::connect();
    }

    public function insertar($nombre) {
    $query="INSERT INTO tiposdocumentos (nombredocumento) VALUES(?)";
    $stmt=  $this->conn->prepare($query);
    $stmt->bindparam(1,$nombre);
    $stmt->execute();
    }
    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }


}
