<?php

/**
 * Class that operate on table 'examenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
class ExamenesMySqlDAO implements ExamenesDAO {

    /**
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return ExamenesMySql 
     */
    public function load($id) {
        $sql = 'SELECT * FROM examenes WHERE idExamen = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM examenes';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM examenes ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param examene primary key
     */
    public function delete($idExamen) {
        $sql = 'DELETE FROM examenes WHERE idExamen = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idExamen);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param ExamenesMySql examene
     */
    public function insert($examene) {
        $sql = 'INSERT INTO examenes (idCurso, idProfesor, fechaInicio, horaInicio, fechaFin, horaFin, idEstadoExamen) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->setNumber($examene->idCurso);
        $sqlQuery->setNumber($examene->idProfesor);
        $sqlQuery->set($examene->fechaInicio);
        $sqlQuery->set($examene->horaInicio);
        $sqlQuery->set($examene->fechaFin);
        $sqlQuery->set($examene->horaFin);
        $sqlQuery->setNumber($examene->idEstadoExamen);

        $id = $this->executeInsert($sqlQuery);
        $examene->idExamen = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param ExamenesMySql examene
     */
    public function update($examene) {
        $sql = 'UPDATE examenes SET idCurso = ?, idProfesor = ?, fechaInicio = ?, horaInicio = ?, fechaFin = ?, horaFin = ?, idEstadoExamen = ? WHERE idExamen = ?';
        $sqlQuery = new SqlQuery($sql);

        $sqlQuery->setNumber($examene->idCurso);
        $sqlQuery->setNumber($examene->idProfesor);
        $sqlQuery->set($examene->fechaInicio);
        $sqlQuery->set($examene->horaInicio);
        $sqlQuery->set($examene->fechaFin);
        $sqlQuery->set($examene->horaFin);
        $sqlQuery->setNumber($examene->idEstadoExamen);

        $sqlQuery->setNumber($examene->idExamen);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM examenes';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByIdCurso($value) {
        $sql = 'SELECT * FROM examenes WHERE idCurso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function queryByIdProfesor($value) {
        $sql = 'SELECT * FROM examenes WHERE idProfesor = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function queryByFechaInicio($value) {
        $sql = 'SELECT * FROM examenes WHERE fechaInicio = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByHoraInicio($value) {
        $sql = 'SELECT * FROM examenes WHERE horaInicio = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByFechaFin($value) {
        $sql = 'SELECT * FROM examenes WHERE fechaFin = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByHoraFin($value) {
        $sql = 'SELECT * FROM examenes WHERE horaFin = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByIdEstadoExamen($value) {
        $sql = 'SELECT * FROM examenes WHERE idEstadoExamen = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByIdCurso($value) {
        $sql = 'DELETE FROM examenes WHERE idCurso = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByIdProfesor($value) {
        $sql = 'DELETE FROM examenes WHERE idProfesor = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByFechaInicio($value) {
        $sql = 'DELETE FROM examenes WHERE fechaInicio = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByHoraInicio($value) {
        $sql = 'DELETE FROM examenes WHERE horaInicio = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByFechaFin($value) {
        $sql = 'DELETE FROM examenes WHERE fechaFin = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByHoraFin($value) {
        $sql = 'DELETE FROM examenes WHERE horaFin = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByIdEstadoExamen($value) {
        $sql = 'DELETE FROM examenes WHERE idEstadoExamen = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return ExamenesMySql 
     */
    protected function readRow($row) {
        $examene = new Examene();

        $examene->idExamen = $row['idExamen'];
        $examene->idCurso = $row['idCurso'];
        $examene->idProfesor = $row['idProfesor'];
        $examene->fechaInicio = $row['fechaInicio'];
        $examene->horaInicio = $row['horaInicio'];
        $examene->fechaFin = $row['fechaFin'];
        $examene->horaFin = $row['horaFin'];
        $examene->idEstadoExamen = $row['idEstadoExamen'];

        return $examene;
    }

    protected function getList($sqlQuery) {
        $tab = QueryExecutor::execute($sqlQuery);
        $ret = array();
        for ($i = 0; $i < count($tab); $i++) {
            $ret[$i] = $this->readRow($tab[$i]);
        }
        return $ret;
    }

    /**
     * Get row
     *
     * @return ExamenesMySql 
     */
    protected function getRow($sqlQuery) {
        $tab = QueryExecutor::execute($sqlQuery);
        if (count($tab) == 0) {
            return null;
        }
        return $this->readRow($tab[0]);
    }

    /**
     * Execute sql query
     */
    protected function execute($sqlQuery) {
        return QueryExecutor::execute($sqlQuery);
    }

    /**
     * Execute sql query
     */
    protected function executeUpdate($sqlQuery) {
        return QueryExecutor::executeUpdate($sqlQuery);
    }

    /**
     * Query for one row and one column
     */
    protected function querySingleResult($sqlQuery) {
        return QueryExecutor::queryForString($sqlQuery);
    }

    /**
     * Insert row to table
     */
    protected function executeInsert($sqlQuery) {
        return QueryExecutor::executeInsert($sqlQuery);
    }

}

?>