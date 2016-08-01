<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface EstadosexamenesDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @Return Estadosexamenes 
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
     * @param estadosexamene primary key
     */
    public function delete($idEstadosExamen);

    /**
     * Insert record to table
     *
     * @param Estadosexamenes estadosexamene
     */
    public function insert($estadosexamene);

    /**
     * Update record in table
     *
     * @param Estadosexamenes estadosexamene
     */
    public function update($estadosexamene);

    /**
     * Delete all rows
     */
    public function clean();

    public function queryByNombreEstadoExamen($value);

    public function deleteByNombreEstadoExamen($value);
}

?>