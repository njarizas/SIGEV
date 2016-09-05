<?php

/**
 * Class that operate on table 'roles'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/RolesDAO.class.php';

class RolesMySqlDAO implements RolesDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function listarTodos() {
        $query = "SELECT * FROM roles ORDER BY nombrerol";
        return $this->conn->query($query);
    }

    public function insertar($nombreRol) {
        $query = "INSERT INTO roles (nombrerol) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $nombreRol);
        return $stmt->execute();
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
