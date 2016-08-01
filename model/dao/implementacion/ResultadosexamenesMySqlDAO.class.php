<?php
/**
 * Class that operate on table 'resultadosexamenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class ResultadosexamenesMySqlDAO implements ResultadosexamenesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ResultadosexamenesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM resultadosexamenes WHERE idResultadosExamenes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM resultadosexamenes';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM resultadosexamenes ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param resultadosexamene primary key
 	 */
	public function delete($idResultadosExamenes){
		$sql = 'DELETE FROM resultadosexamenes WHERE idResultadosExamenes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idResultadosExamenes);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ResultadosexamenesMySql resultadosexamene
 	 */
	public function insert($resultadosexamene){
		$sql = 'INSERT INTO resultadosexamenes (idEstudiante, idExamen, nota) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($resultadosexamene->idEstudiante);
		$sqlQuery->setNumber($resultadosexamene->idExamen);
		$sqlQuery->setNumber($resultadosexamene->nota);

		$id = $this->executeInsert($sqlQuery);	
		$resultadosexamene->idResultadosExamenes = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ResultadosexamenesMySql resultadosexamene
 	 */
	public function update($resultadosexamene){
		$sql = 'UPDATE resultadosexamenes SET idEstudiante = ?, idExamen = ?, nota = ? WHERE idResultadosExamenes = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($resultadosexamene->idEstudiante);
		$sqlQuery->setNumber($resultadosexamene->idExamen);
		$sqlQuery->setNumber($resultadosexamene->nota);

		$sqlQuery->setNumber($resultadosexamene->idResultadosExamenes);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM resultadosexamenes';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdEstudiante($value){
		$sql = 'SELECT * FROM resultadosexamenes WHERE idEstudiante = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdExamen($value){
		$sql = 'SELECT * FROM resultadosexamenes WHERE idExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNota($value){
		$sql = 'SELECT * FROM resultadosexamenes WHERE nota = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdEstudiante($value){
		$sql = 'DELETE FROM resultadosexamenes WHERE idEstudiante = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdExamen($value){
		$sql = 'DELETE FROM resultadosexamenes WHERE idExamen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNota($value){
		$sql = 'DELETE FROM resultadosexamenes WHERE nota = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ResultadosexamenesMySql 
	 */
	protected function readRow($row){
		$resultadosexamene = new Resultadosexamene();
		
		$resultadosexamene->idResultadosExamenes = $row['idResultadosExamenes'];
		$resultadosexamene->idEstudiante = $row['idEstudiante'];
		$resultadosexamene->idExamen = $row['idExamen'];
		$resultadosexamene->nota = $row['nota'];

		return $resultadosexamene;
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
	 * @return ResultadosexamenesMySql 
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