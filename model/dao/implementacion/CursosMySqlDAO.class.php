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

    public function listarTodos() {
        $query = "SELECT * FROM cursos ORDER BY nombrecurso";
        return $this->conn->query($query);
    }

    public function insertar($nombreCurso,$codigoCurso) {
        $query = "INSERT INTO cursos (nombrecurso,codigocurso) VALUES(?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $nombreCurso);
        $stmt->bindparam(2, $codigoCurso);
        return $stmt->execute();
    }
    
    public function existeCursoConCodigo($codigoCurso) {
        $query = "SELECT * FROM  cursos WHERE codigocurso=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $codigoCurso);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if (count($rows)!=0){
            return true;
        }
        else{
            return false;
        }
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
