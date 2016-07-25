<?php
/**
 * Class that operate on table 'estadosexamenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class EstadosexamenesMySqlDAO implements EstadosexamenesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return EstadosexamenesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM estadosexamenes WHERE idEstadosExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM estadosexamenes';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM estadosexamenes ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param estadosexamene primary key
 	 */
	public function delete($idEstadosExamen){
		$sql = 'DELETE FROM estadosexamenes WHERE idEstadosExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idEstadosExamen);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param EstadosexamenesMySql estadosexamene
 	 */
	public function insert($estadosexamene){
		$sql = 'INSERT INTO estadosexamenes (nombreEstadoExamen) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($estadosexamene->nombreEstadoExamen);

		$id = $this->executeInsert($sqlQuery);	
		$estadosexamene->idEstadosExamen = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param EstadosexamenesMySql estadosexamene
 	 */
	public function update($estadosexamene){
		$sql = 'UPDATE estadosexamenes SET nombreEstadoExamen = ? WHERE idEstadosExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($estadosexamene->nombreEstadoExamen);

		$sqlQuery->setNumber($estadosexamene->idEstadosExamen);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM estadosexamenes';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombreEstadoExamen($value){
		$sql = 'SELECT * FROM estadosexamenes WHERE nombreEstadoExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombreEstadoExamen($value){
		$sql = 'DELETE FROM estadosexamenes WHERE nombreEstadoExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return EstadosexamenesMySql 
	 */
	protected function readRow($row){
		$estadosexamene = new Estadosexamene();
		
		$estadosexamene->idEstadosExamen = $row['idEstadosExamen'];
		$estadosexamene->nombreEstadoExamen = $row['nombreEstadoExamen'];

		return $estadosexamene;
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
	 * @return EstadosexamenesMySql 
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