<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
interface TiposdocumentosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Tiposdocumentos 
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
 	 * @param tiposdocumento primary key
 	 */
	public function delete($idTipoDocumento);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Tiposdocumentos tiposdocumento
 	 */
	public function insert($tiposdocumento);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Tiposdocumentos tiposdocumento
 	 */
	public function update($tiposdocumento);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombreDocumento($value);


	public function deleteByNombreDocumento($value);


}
?>