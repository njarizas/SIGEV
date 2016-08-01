<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface RespuestasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Respuestas 
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
 	 * @param respuesta primary key
 	 */
	public function delete($idRespuesta);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Respuestas respuesta
 	 */
	public function insert($respuesta);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Respuestas respuesta
 	 */
	public function update($respuesta);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdPregunta($value);

	public function queryByRespuesta($value);


	public function deleteByIdPregunta($value);

	public function deleteByRespuesta($value);


}
?>