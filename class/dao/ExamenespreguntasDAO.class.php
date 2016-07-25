<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface ExamenespreguntasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Examenespreguntas 
	 */
	public function load($idExamen, $idPregunta);

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
 	 * @param examenespregunta primary key
 	 */
	public function delete($idExamen, $idPregunta);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Examenespreguntas examenespregunta
 	 */
	public function insert($examenespregunta);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Examenespreguntas examenespregunta
 	 */
	public function update($examenespregunta);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>