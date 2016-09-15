<?php

/**
 * Class that operate on table 'respuestas'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/respuestasDAO.class.php';

class RespuestasMySqlDAO implements RespuestasDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function listarTodos() {
        $query = "SELECT * FROM respuestas ORDER BY idrespuesta";
        return $this->conn->query($query);
    }

    public function insertar($respuesta) {
        $query = 'INSERT INTO respuestas (idpregunta, respuesta) VALUES (?,?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $respuesta->getIdPregunta());
        $stmt->bindparam(2, $respuesta->getRespuesta());
        return $stmt->execute();
    }

    public function actualizar($respuesta) {
        $query = 'UPDATE respuestas SET idpregunta=?, respuesta=? WHERE idrespuesta=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $respuesta->getIdPregunta());
        $stmt->bindparam(2, $respuesta->getRespuesta());
        $stmt->bindparam(3, $respuesta->getIdRespuesta());
        return $stmt->execute();
    }

    public function obtenerUltimoRegistroInsertado() {
        $query = "SELECT * FROM respuestas ORDER BY idrespuesta DESC LIMIT 1";
        return $this->conn->query($query);
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
