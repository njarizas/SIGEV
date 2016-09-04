<?php

/**
 * Class that operate on table 'cursos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/CursosDAO.class.php';

class CursosMySqlDAO implements CursosDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }
    
    public function listarCursos() {
        $query = "SELECT * FROM cursos ORDER BY nombrecurso";
        return $this->conn->query($query);
    }
    
        public function listarTodos() {
        $query = "SELECT * FROM cursos ORDER BY nombrecurso";
        return $this->conn->query($query);
    }

    public function insertar($nombreCurso) {
        $query = "INSERT INTO cursos (nombrecurso) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $nombreCurso);
        return $stmt->execute();
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }
}