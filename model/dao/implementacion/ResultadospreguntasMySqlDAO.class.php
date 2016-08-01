<?php
/**
 * Class that operate on table 'resultadospreguntas'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class ResultadospreguntasMySqlDAO implements ResultadospreguntasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ResultadospreguntasMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM resultadospreguntas WHERE idResultadosPreguntas = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM resultadospreguntas';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM resultadospreguntas ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param resultadospregunta primary key
 	 */
	public function delete($idResultadosPreguntas){
		$sql = 'DELETE FROM resultadospreguntas WHERE idResultadosPreguntas = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idResultadosPreguntas);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ResultadospreguntasMySql resultadospregunta
 	 */
	public function insert($resultadospregunta){
		$sql = 'INSERT INTO resultadospreguntas (idResultadosExamenes, idRespuesta, idPregunta) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($resultadospregunta->idResultadosExamenes);
		$sqlQuery->setNumber($resultadospregunta->idRespuesta);
		$sqlQuery->setNumber($resultadospregunta->idPregunta);

		$id = $this->executeInsert($sqlQuery);	
		$resultadospregunta->idResultadosPreguntas = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ResultadospreguntasMySql resultadospregunta
 	 */
	public function update($resultadospregunta){
		$sql = 'UPDATE resultadospreguntas SET idResultadosExamenes = ?, idRespuesta = ?, idPregunta = ? WHERE idResultadosPreguntas = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($resultadospregunta->idResultadosExamenes);
		$sqlQuery->setNumber($resultadospregunta->idRespuesta);
		$sqlQuery->setNumber($resultadospregunta->idPregunta);

		$sqlQuery->setNumber($resultadospregunta->idResultadosPreguntas);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM resultadospreguntas';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdResultadosExamenes($value){
		$sql = 'SELECT * FROM resultadospreguntas WHERE idResultadosExamenes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdRespuesta($value){
		$sql = 'SELECT * FROM resultadospreguntas WHERE idRespuesta = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdPregunta($value){
		$sql = 'SELECT * FROM resultadospreguntas WHERE idPregunta = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdResultadosExamenes($value){
		$sql = 'DELETE FROM resultadospreguntas WHERE idResultadosExamenes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdRespuesta($value){
		$sql = 'DELETE FROM resultadospreguntas WHERE idRespuesta = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdPregunta($value){
		$sql = 'DELETE FROM resultadospreguntas WHERE idPregunta = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ResultadospreguntasMySql 
	 */
	protected function readRow($row){
		$resultadospregunta = new Resultadospregunta();
		
		$resultadospregunta->idResultadosPreguntas = $row['idResultadosPreguntas'];
		$resultadospregunta->idResultadosExamenes = $row['idResultadosExamenes'];
		$resultadospregunta->idRespuesta = $row['idRespuesta'];
		$resultadospregunta->idPregunta = $row['idPregunta'];

		return $resultadospregunta;
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
	 * @return ResultadospreguntasMySql 
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