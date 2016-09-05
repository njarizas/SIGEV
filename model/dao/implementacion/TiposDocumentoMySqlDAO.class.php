<?php

/**
 * Class that operate on table 'tiposdocumentos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/TiposDocumentoDAO.class.php';

class TiposDocumentoMySqlDAO implements TiposDocumentoDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }
    
      public function listarTodos() {
        $query = "SELECT * FROM  tiposdocumentos ORDER BY nombredocumento";
        return $this->conn->query($query);
    }

    public function insertar($nombreDocumento) {
        $query = "INSERT INTO tiposdocumentos (nombredocumento) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $nombreDocumento);
        $stmt->execute();
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
