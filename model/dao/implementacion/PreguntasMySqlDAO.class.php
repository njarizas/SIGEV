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

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return PreguntasMySql 
     */
    public function load($id) {
        $sql = 'SELECT * FROM preguntas WHERE idPregunta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM preguntas';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM preguntas ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param pregunta primary key
     */
    public function delete($idPregunta) {
        $sql = 'DELETE FROM preguntas WHERE idPregunta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idPregunta);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param PreguntasMySql pregunta
     */
    public function insert($pregunta) {
        $sql = 'INSERT INTO preguntas (enunciado, valorPregunta, idCurso) VALUES (?, ?, ?)';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($pregunta->enunciado);
        $sqlQuery->setNumber($pregunta->valorPregunta);
        $sqlQuery->setNumber($pregunta->idCurso);

        $id = $this->executeInsert($sqlQuery);
        $pregunta->idPregunta = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param PreguntasMySql pregunta
     */
    public function update($pregunta) {
        $sql = 'UPDATE preguntas SET enunciado = ?, valorPregunta = ?, idCurso = ? WHERE idPregunta = ?';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($pregunta->enunciado);
        $sqlQuery->setNumber($pregunta->valorPregunta);
        $sqlQuery->setNumber($pregunta->idCurso);

        $sqlQuery->setNumber($pregunta->idPregunta);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM preguntas';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByEnunciado($value) {
        $sql = 'SELECT * FROM preguntas WHERE enunciado = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByValorPregunta($value) {
        $sql = 'SELECT * FROM preguntas WHERE valorPregunta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function queryByIdCurso($value) {
        $sql = 'SELECT * FROM preguntas WHERE idCurso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByEnunciado($value) {
        $sql = 'DELETE FROM preguntas WHERE enunciado = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByValorPregunta($value) {
        $sql = 'DELETE FROM preguntas WHERE valorPregunta = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByIdCurso($value) {
        $sql = 'DELETE FROM preguntas WHERE idCurso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return PreguntasMySql 
     */
    protected function readRow($row) {
        $pregunta = new Pregunta();

        $pregunta->idPregunta = $row['idPregunta'];
        $pregunta->enunciado = $row['enunciado'];
        $pregunta->valorPregunta = $row['valorPregunta'];
        $pregunta->idCurso = $row['idCurso'];

        return $pregunta;
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
     * @return PreguntasMySql 
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

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}

?>