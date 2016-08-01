<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface UsuariosRolesDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @Return UsuariosRoles 
     */
    public function load($idUsuario, $idRol);

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
     * @param usuariosRole primary key
     */
    public function delete($idUsuario, $idRol);

    /**
     * Insert record to table
     *
     * @param UsuariosRoles usuariosRole
     */
    public function insert($usuariosRole);

    /**
     * Update record in table
     *
     * @param UsuariosRoles usuariosRole
     */
    public function update($usuariosRole);

    /**
     * Delete all rows
     */
    public function clean();
}

?>