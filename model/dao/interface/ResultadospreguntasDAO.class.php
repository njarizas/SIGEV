<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface ResultadospreguntasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Resultadospreguntas 
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
 	 * @param resultadospregunta primary key
 	 */
	public function delete($idResultadosPreguntas);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Resultadospreguntas resultadospregunta
 	 */
	public function insert($resultadospregunta);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Resultadospreguntas resultadospregunta
 	 */
	public function update($resultadospregunta);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdResultadosExamenes($value);

	public function queryByIdRespuesta($value);

	public function queryByIdPregunta($value);


	public function deleteByIdResultadosExamenes($value);

	public function deleteByIdRespuesta($value);

	public function deleteByIdPregunta($value);


}
?>