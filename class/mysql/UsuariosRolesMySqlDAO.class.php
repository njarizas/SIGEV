<?php
/**
 * Class that operate on table 'usuarios_roles'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class UsuariosRolesMySqlDAO implements UsuariosRolesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UsuariosRolesMySql 
	 */
	public function load($idUsuario, $idRol){
		$sql = 'SELECT * FROM usuarios_roles WHERE idUsuario = ?  AND idRol = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idUsuario);
		$sqlQuery->setNumber($idRol);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM usuarios_roles';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM usuarios_roles ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param usuariosRole primary key
 	 */
	public function delete($idUsuario, $idRol){
		$sql = 'DELETE FROM usuarios_roles WHERE idUsuario = ?  AND idRol = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idUsuario);
		$sqlQuery->setNumber($idRol);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UsuariosRolesMySql usuariosRole
 	 */
	public function insert($usuariosRole){
		$sql = 'INSERT INTO usuarios_roles ( idUsuario, idRol) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($usuariosRole->idUsuario);

		$sqlQuery->setNumber($usuariosRole->idRol);

		$this->executeInsert($sqlQuery);	
		//$usuariosRole->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UsuariosRolesMySql usuariosRole
 	 */
	public function update($usuariosRole){
		$sql = 'UPDATE usuarios_roles SET  WHERE idUsuario = ?  AND idRol = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($usuariosRole->idUsuario);

		$sqlQuery->setNumber($usuariosRole->idRol);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM usuarios_roles';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return UsuariosRolesMySql 
	 */
	protected function readRow($row){
		$usuariosRole = new UsuariosRole();
		
		$usuariosRole->idUsuario = $row['idUsuario'];
		$usuariosRole->idRol = $row['idRol'];

		return $usuariosRole;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return UsuariosRolesMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>