<?php

/**
 * Class that operate on table 'estadosexamenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/EstadosExamenesDAO.class.php';

class EstadosExamenesMySqlDAO implements EstadosExamenesDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function listarTodos() {
        $query = "SELECT * FROM estadosexamenes ORDER BY nombreestadoexamen";
        return $this->conn->query($query);
    }

    public function insertar($nombreEstadoExamen) {
        $query = "INSERT INTO estadosexamenes (nombreestadoexamen) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $nombreEstadoExamen);
        return $stmt->execute();
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}