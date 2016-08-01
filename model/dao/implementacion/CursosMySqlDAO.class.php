<?php
/**
 * Class that operate on table 'cursos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/CursosDAO.class.php';

class CursosMySqlDAO implements CursosDAO{

    
      private $conn;
    
    function __construct() {
        $this->conn= Database::connect();
    }
	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CursosMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM cursos WHERE idCurso = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM cursos';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM cursos ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param curso primary key
 	 */
	public function delete($idCurso){
		$sql = 'DELETE FROM cursos WHERE idCurso = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idCurso);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CursosMySql curso
 	 */
	public function insert($curso){
		$sql = 'INSERT INTO cursos (nombreCurso) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($curso->nombreCurso);

		$id = $this->executeInsert($sqlQuery);	
		$curso->idCurso = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CursosMySql curso
 	 */
	public function update($curso){
		$sql = 'UPDATE cursos SET nombreCurso = ? WHERE idCurso = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($curso->nombreCurso);

		$sqlQuery->setNumber($curso->idCurso);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM cursos';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombreCurso($value){
		$sql = 'SELECT * FROM cursos WHERE nombreCurso = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombreCurso($value){
		$sql = 'DELETE FROM cursos WHERE nombreCurso = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CursosMySql 
	 */
	protected function readRow($row){
		$curso = new Curso();
		
		$curso->idCurso = $row['idCurso'];
		$curso->nombreCurso = $row['nombreCurso'];

		return $curso;
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
	 * @return CursosMySql 
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

    public function listarCursos() {
    $query="SELECT * FROM cursos ORDER BY nombrecurso";
    return $this->conn->query($query);
    }
    
    public function insertar($nombreCurso) {
    $query="INSERT INTO cursos (nombrecurso) VALUES(?)";
    $stmt=  $this->conn->prepare($query);
    $stmt->bindparam(1,$nombreCurso);
    return $stmt->execute();
    }
    
    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }
	
}
?>