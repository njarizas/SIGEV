<?php

/**
 * Class that operate on table 'examenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/ExamenesDAO.class.php';

class ExamenesMySqlDAO implements ExamenesDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function listarTodos() {
        $query = "SELECT * FROM examenes ORDER BY idexamen";
        return $this->conn->query($query);
    }

    public function obtenerUltimoRegistroInsertado() {
        $query = "SELECT * FROM examenes ORDER BY idexamen DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
//        echo 'El id del ultimo registro insertado es '.$row['idexamen'];
        return $row;
    }

    public function insertar($examen) {
        $query = "INSERT INTO examenes (idcurso,idprofesor,fechainicio,fechafin,idestadoexamen,ficha) VALUES(?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $examen->getIdCurso());
        $stmt->bindparam(2, $examen->getIdProfesor());
        $stmt->bindparam(3, $examen->getFechaInicio());
        $stmt->bindparam(4, $examen->getFechaFin());
        $stmt->bindparam(5, $examen->getIdEstadoExamen());
        $stmt->bindparam(6, $examen->getFicha());
        return $stmt->execute();
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
