<?php

/**
 * Class that operate on table 'resultadospreguntas'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/ResultadosPreguntasDAO.class.php';

class ResultadosPreguntasMySqlDAO implements ResultadosPreguntasDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function insertar($resultadoPreguntaDTO) {
         $query = "INSERT INTO resultadospreguntas (idresultadoexamen,idpregunta,idrespuesta) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $resultadoPreguntaDTO->getIdResultadoExamen());
        $stmt->bindparam(2, $resultadoPreguntaDTO->getIdPregunta());
        $stmt->bindparam(3, $resultadoPreguntaDTO->getIdRespuesta());
        return $stmt->execute();
    }

    public function listarTodos() {
        $query = "SELECT * FROM  resultadospreguntas ORDER BY idresultadopregunta";
        return $this->conn->query($query);
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
