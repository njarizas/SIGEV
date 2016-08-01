<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface RolesPermisosDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @Return RolesPermisos 
     */
    public function load($idPermiso, $idRol);

    /**
     * Get all records from table
     */
    public function queryAll();

    /**
     * Get all records from table ordered by field
     * @Param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn);

    /**
     * Delete record from table
     * @param rolesPermiso primary key
     */
    public function delete($idPermiso, $idRol);

    /**
     * Insert record to table
     *
     * @param RolesPermisos rolesPermiso
     */
    public function insert($rolesPermiso);

    /**
     * Update record in table
     *
     * @param RolesPermisos rolesPermiso
     */
    public function update($rolesPermiso);

    /**
     * Delete all rows
     */
    public function clean();
}

?>