<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface ExamenesDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @Return Examenes 
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
     * @param examene primary key
     */
    public function delete($idExamen);

    /**
     * Insert record to table
     *
     * @param Examenes examene
     */
    public function insert($examene);

    /**
     * Update record in table
     *
     * @param Examenes examene
     */
    public function update($examene);

    /**
     * Delete all rows
     */
    public function clean();

    public function queryByIdCurso($value);

    public function queryByIdProfesor($value);

    public function queryByFechaInicio($value);

    public function queryByHoraInicio($value);

    public function queryByFechaFin($value);

    public function queryByHoraFin($value);

    public function queryByIdEstadoExamen($value);

    public function deleteByIdCurso($value);

    public function deleteByIdProfesor($value);

    public function deleteByFechaInicio($value);

    public function deleteByHoraInicio($value);

    public function deleteByFechaFin($value);

    public function deleteByHoraFin($value);

    public function deleteByIdEstadoExamen($value);
}

?>