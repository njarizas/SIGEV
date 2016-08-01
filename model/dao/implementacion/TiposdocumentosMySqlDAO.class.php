<?php

/**
 * Class that operate on table 'tiposdocumentos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/TiposdocumentosDAO.class.php';

class TiposdocumentosMySqlDAO implements TiposdocumentosDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return TiposdocumentosMySql 
     */
    private $conn;

    /**
     * UsuariosMySqlDAO constructor.
     * @param $conn
     */
    function __construct() {
        $this->conn = Database::connect();
    }

    public function load($id) {
        $sql = 'SELECT * FROM tiposdocumentos WHERE idTipoDocumento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM tiposdocumentos';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM tiposdocumentos ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param tiposdocumento primary key
     */
    public function delete($idTipoDocumento) {
        $sql = 'DELETE FROM tiposdocumentos WHERE idTipoDocumento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idTipoDocumento);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param TiposdocumentosMySql tiposdocumento
     */
    public function insert($tiposdocumento) {
        $sql = 'INSERT INTO tiposdocumentos (nombreDocumento) VALUES (?)';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($tiposdocumento->nombreDocumento);

        $id = $this->executeInsert($sqlQuery);
        $tiposdocumento->idTipoDocumento = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param TiposdocumentosMySql tiposdocumento
     */
    public function update($tiposdocumento) {
        $sql = 'UPDATE tiposdocumentos SET nombreDocumento = ? WHERE idTipoDocumento = ?';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($tiposdocumento->nombreDocumento);

        $sqlQuery->setNumber($tiposdocumento->idTipoDocumento);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM tiposdocumentos';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByNombreDocumento($value) {
        $sql = 'SELECT * FROM tiposdocumentos WHERE nombreDocumento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByNombreDocumento($value) {
        $sql = 'DELETE FROM tiposdocumentos WHERE nombreDocumento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return TiposdocumentosMySql 
     */
    protected function readRow($row) {
        $tiposdocumento = new Tiposdocumento();

        $tiposdocumento->idTipoDocumento = $row['idTipoDocumento'];
        $tiposdocumento->nombreDocumento = $row['nombreDocumento'];

        return $tiposdocumento;
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
     * @return TiposdocumentosMySql 
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

    public function listarDoc() {
        $query = "SELECT * FROM tiposdocumentos";
        return $this->conn->query($query);
    }

    /**
     * @return mixed
     */
    public function getConn() {
        return $this->conn;
    }

    /**
     * @param mixed $conn
     */
    public function setConn($conn) {
        $this->conn = $conn;
    }

}

?>