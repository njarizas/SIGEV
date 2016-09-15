<?php

/**
 * Class that operate on table 'preguntas'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/PreguntasDAO.class.php';

class PreguntasMySqlDAO implements PreguntasDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function listarTodos() {
        $query = "SELECT * FROM  preguntas ORDER BY idpregunta";
        return $this->conn->query($query);
    }

    public function insertar($pregunta) {
        $query = 'INSERT INTO preguntas (enunciado, valorpregunta, idcurso) VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $pregunta->getEnunciado());
        $stmt->bindparam(2, $pregunta->getValorPregunta());
        $stmt->bindparam(3, $pregunta->getIdCurso());
        return $stmt->execute();
    }

    public function actualizar($pregunta) {
        $query = 'UPDATE preguntas SET enunciado=?, valorpregunta=?, idcurso=? WHERE idpregunta=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $pregunta->getEnunciado());
        $stmt->bindparam(2, $pregunta->getValorPregunta());
        $stmt->bindparam(3, $pregunta->getIdCurso());
        $stmt->bindparam(4, $pregunta->getIdPregunta());
        return $stmt->execute();
    }

    public function obtenerUltimoRegistroInsertado() {
        $query = "SELECT * FROM preguntas ORDER BY idpregunta DESC LIMIT 1";
        return $this->conn->query($query);
    }

    public function buscarPreguntasPorCurso($idCurso) {
        $query = "SELECT * FROM  preguntas WHERE idcurso=" . $idCurso . " ORDER BY idpregunta";
        return $this->conn->query($query);
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
