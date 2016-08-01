<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface PermisosDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @Return Permisos 
     */
    public function load($id);

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
     * @param permiso primary key
     */
    public function delete($idPermiso);

    /**
     * Insert record to table
     *
     * @param Permisos permiso
     */
    public function insert($permiso);

    /**
     * Update record in table
     *
     * @param Permisos permiso
     */
    public function update($permiso);

    /**
     * Delete all rows
     */
    public function clean();

    public function queryByNombrePermiso($value);

    public function deleteByNombrePermiso($value);
}

?>