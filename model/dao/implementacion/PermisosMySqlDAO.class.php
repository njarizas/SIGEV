<?php

/**
 * Class that operate on table 'permisos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class PermisosMySqlDAO implements PermisosDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return PermisosMySql 
     */
    public function load($id) {
        $sql = 'SELECT * FROM permisos WHERE idPermiso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM permisos';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM permisos ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param permiso primary key
     */
    public function delete($idPermiso) {
        $sql = 'DELETE FROM permisos WHERE idPermiso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idPermiso);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param PermisosMySql permiso
     */
    public function insert($permiso) {
        $sql = 'INSERT INTO permisos (nombrePermiso) VALUES (?)';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($permiso->nombrePermiso);

        $id = $this->executeInsert($sqlQuery);
        $permiso->idPermiso = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param PermisosMySql permiso
     */
    public function update($permiso) {
        $sql = 'UPDATE permisos SET nombrePermiso = ? WHERE idPermiso = ?';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($permiso->nombrePermiso);

        $sqlQuery->setNumber($permiso->idPermiso);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM permisos';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByNombrePermiso($value) {
        $sql = 'SELECT * FROM permisos WHERE nombrePermiso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByNombrePermiso($value) {
        $sql = 'DELETE FROM permisos WHERE nombrePermiso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return PermisosMySql 
     */
    protected function readRow($row) {
        $permiso = new Permiso();

        $permiso->idPermiso = $row['idPermiso'];
        $permiso->nombrePermiso = $row['nombrePermiso'];

        return $permiso;
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
     * @return PermisosMySql 
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

}

?>