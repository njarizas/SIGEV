<?php

/**
 * Class that operate on table 'roles_permisos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class RolesPermisosMySqlDAO implements RolesPermisosDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return RolesPermisosMySql 
     */
    public function load($idPermiso, $idRol) {
        $sql = 'SELECT * FROM roles_permisos WHERE idPermiso = ?  AND idRol = ? ';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idPermiso);
        $sqlQuery->setNumber($idRol);

        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM roles_permisos';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM roles_permisos ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param rolesPermiso primary key
     */
    public function delete($idPermiso, $idRol) {
        $sql = 'DELETE FROM roles_permisos WHERE idPermiso = ?  AND idRol = ? ';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idPermiso);
        $sqlQuery->setNumber($idRol);

        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param RolesPermisosMySql rolesPermiso
     */
    public function insert($rolesPermiso) {
        $sql = 'INSERT INTO roles_permisos ( idPermiso, idRol) VALUES ( ?, ?)';
        $sqlQuery = new SqlQuery($sql);



        $sqlQuery->setNumber($rolesPermiso->idPermiso);

        $sqlQuery->setNumber($rolesPermiso->idRol);

        $this->executeInsert($sqlQuery);
        //$rolesPermiso->id = $id;
        //return $id;
    }

    /**
     * Update record in table
     *
     * @param RolesPermisosMySql rolesPermiso
     */
    public function update($rolesPermiso) {
        $sql = 'UPDATE roles_permisos SET  WHERE idPermiso = ?  AND idRol = ? ';
        $sqlQuery = new SqlQuery($sql);



        $sqlQuery->setNumber($rolesPermiso->idPermiso);

        $sqlQuery->setNumber($rolesPermiso->idRol);

        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM roles_permisos';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return RolesPermisosMySql 
     */
    protected function readRow($row) {
        $rolesPermiso = new RolesPermiso();

        $rolesPermiso->idPermiso = $row['idPermiso'];
        $rolesPermiso->idRol = $row['idRol'];

        return $rolesPermiso;
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
     * @return RolesPermisosMySql 
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