<?php
/**
 * Description of FichasMySqlDAO
 *
 * @author Nelson
 */

require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/FichasDAO.class.php';

class FichasMySqlDAO implements FichasDAO{
  
    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }
    
      public function listarTodos() {
        $query = "SELECT * FROM  fichas ORDER BY ficha";
        return $this->conn->query($query);
    }

    public function insertar($ficha) {
        $query = "INSERT INTO fichas (ficha) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $ficha);
        $stmt->execute();
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
