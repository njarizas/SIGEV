<?php

/**
 * Class that operate on table 'resultadosexamenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */

require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/ResultadosExamenesDAO.class.php';

class ResultadosExamenesMySqlDAO implements ResultadosExamenesDAO {
    
        private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }
 
    public function insertar($resultadoExamen) {
        
    }

    public function listarTodos() {
        $query = "SELECT * FROM  resultadosexamenes ORDER BY idresultadoexamen";
        return $this->conn->query($query);
    }
    
    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}