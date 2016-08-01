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

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return RespuestasMySql 
     */
    public function load($id) {
        $sql = 'SELECT * FROM respuestas WHERE idRespuesta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM respuestas';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM respuestas ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param respuesta primary key
     */
    public function delete($idRespuesta) {
        $sql = 'DELETE FROM respuestas WHERE idRespuesta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idRespuesta);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param RespuestasMySql respuesta
     */
    public function insert($respuesta) {
        $sql = 'INSERT INTO respuestas (idPregunta, respuesta) VALUES (?, ?)';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->setNumber($respuesta->idPregunta);
        $sqlQuery->set($respuesta->respuesta);

        $id = $this->executeInsert($sqlQuery);
        $respuesta->idRespuesta = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param RespuestasMySql respuesta
     */
    public function update($respuesta) {
        $sql = 'UPDATE respuestas SET idPregunta = ?, respuesta = ? WHERE idRespuesta = ?';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->setNumber($respuesta->idPregunta);
        $sqlQuery->set($respuesta->respuesta);

        $sqlQuery->setNumber($respuesta->idRespuesta);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM respuestas';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByIdPregunta($value) {
        $sql = 'SELECT * FROM respuestas WHERE idPregunta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function queryByRespuesta($value) {
        $sql = 'SELECT * FROM respuestas WHERE respuesta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByIdPregunta($value) {
        $sql = 'DELETE FROM respuestas WHERE idPregunta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByRespuesta($value) {
        $sql = 'DELETE FROM respuestas WHERE respuesta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return RespuestasMySql 
     */
    protected function readRow($row) {
        $respuesta = new Respuesta();

        $respuesta->idRespuesta = $row['idRespuesta'];
        $respuesta->idPregunta = $row['idPregunta'];
        $respuesta->respuesta = $row['respuesta'];

        return $respuesta;
    }

    protected function getList($sqlQuery) {
        $tab = QueryExecutor::execute($sqlQuery);
        $ret = array();
        for ($i = 0; $i < count($tab); $i++) {
            $ret[$i] = $this->readRow($tab[$i]);
        }
        return $ret;
    }

    /**
     * Get row
     *
     * @return RespuestasMySql 
     */
    protected function getRow($sqlQuery) {
        $tab = QueryExecutor::execute($sqlQuery);
        if (count($tab) == 0) {
            return null;
        }
        return $this->readRow($tab[0]);
    }

    /**
     * Execute sql query
     */
    protected function execute($sqlQuery) {
        return QueryExecutor::execute($sqlQuery);
    }

    /**
     * Execute sql query
     */
    protected function executeUpdate($sqlQuery) {
        return QueryExecutor::executeUpdate($sqlQuery);
    }

    /**
     * Query for one row and one column
     */
    protected function querySingleResult($sqlQuery) {
        return QueryExecutor::queryForString($sqlQuery);
    }

    /**
     * Insert row to table
     */
    protected function executeInsert($sqlQuery) {
        return QueryExecutor::executeInsert($sqlQuery);
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

?>