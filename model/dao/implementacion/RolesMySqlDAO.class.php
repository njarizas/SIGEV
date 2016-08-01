<?php

/**
 * Class that operate on table 'roles'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class RolesMySqlDAO implements RolesDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return RolesMySql 
     */
    public function load($id) {
        $sql = 'SELECT * FROM roles WHERE idRol = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM roles';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM roles ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param role primary key
     */
    public function delete($idRol) {
        $sql = 'DELETE FROM roles WHERE idRol = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idRol);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param RolesMySql role
     */
    public function insert($role) {
        $sql = 'INSERT INTO roles (nombreRol) VALUES (?)';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($role->nombreRol);

        $id = $this->executeInsert($sqlQuery);
        $role->idRol = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param RolesMySql role
     */
    public function update($role) {
        $sql = 'UPDATE roles SET nombreRol = ? WHERE idRol = ?';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->set($role->nombreRol);

        $sqlQuery->setNumber($role->idRol);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM roles';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByNombreRol($value) {
        $sql = 'SELECT * FROM roles WHERE nombreRol = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByNombreRol($value) {
        $sql = 'DELETE FROM roles WHERE nombreRol = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return RolesMySql 
     */
    protected function readRow($row) {
        $role = new Role();

        $role->idRol = $row['idRol'];
        $role->nombreRol = $row['nombreRol'];

        return $role;
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
     * @return RolesMySql 
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