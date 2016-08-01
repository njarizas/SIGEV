<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface ResultadosexamenesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Resultadosexamenes 
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
 	 * @param resultadosexamene primary key
 	 */
	public function delete($idResultadosExamenes);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Resultadosexamenes resultadosexamene
 	 */
	public function insert($resultadosexamene);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Resultadosexamenes resultadosexamene
 	 */
	public function update($resultadosexamene);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdEstudiante($value);

	public function queryByIdExamen($value);

	public function queryByNota($value);


	public function deleteByIdEstudiante($value);

	public function deleteByIdExamen($value);

	public function deleteByNota($value);


}
?>