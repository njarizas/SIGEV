<?php

/**
 * Class that operate on table 'examenespreguntas'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/ExamenesPreguntasDAO.class.php';

class ExamenesPreguntasMySqlDAO implements ExamenesPreguntasDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function insertar($examenPreguntaDTO) {
        
    }

    public function listarTodos() {
        $query = "SELECT * FROM examenespreguntas ORDER BY idexamen,idpregunta";
        return $this->conn->query($query);
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
