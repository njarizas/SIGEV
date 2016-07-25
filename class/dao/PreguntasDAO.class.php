<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface PreguntasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Preguntas 
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
 	 * @param pregunta primary key
 	 */
	public function delete($idPregunta);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Preguntas pregunta
 	 */
	public function insert($pregunta);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Preguntas pregunta
 	 */
	public function update($pregunta);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByEnunciado($value);

	public function queryByValorPregunta($value);

	public function queryByIdCurso($value);


	public function deleteByEnunciado($value);

	public function deleteByValorPregunta($value);

	public function deleteByIdCurso($value);


}
?>