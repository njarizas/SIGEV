<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface UsuariosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Usuarios 
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
 	 * @param usuario primary key
 	 */
	public function delete($idUsuario);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Usuarios usuario
 	 */
	public function insert($usuario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Usuarios usuario
 	 */
	public function update($usuario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdTipoDocumento($value);

	public function queryByDocumento($value);

	public function queryByNombres($value);

	public function queryByApellido1($value);

	public function queryByApellido2($value);

	public function queryByCorreo($value);

	public function queryByConstrasena($value);


	public function deleteByIdTipoDocumento($value);

	public function deleteByDocumento($value);

	public function deleteByNombres($value);

	public function deleteByApellido1($value);

	public function deleteByApellido2($value);

	public function deleteByCorreo($value);

	public function deleteByConstrasena($value);


}
?>