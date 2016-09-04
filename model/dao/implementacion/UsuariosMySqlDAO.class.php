<?php

/**
 * Class that operate on table 'usuarios'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/UsuariosDAO.class.php';

class UsuariosMySqlDAO implements UsuariosDAO {
    /*
     * Get Domain object by primry key
     *
     * @param String $id primary key
     * @return UsuariosMySql
     */

    private $conn;

    /**
     * UsuariosMySqlDAO constructor.
     * @param $conn
     */
    function __construct() {
        $this->conn = Database::connect();
    }

    public function load($id) {
        $sql = 'SELECT * FROM usuarios WHERE idUsuario = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($id);
        return $this->getRow($sqlQuery);
    }

    /**
     * Get all records from table
     */
    public function queryAll() {
        $sql = 'SELECT * FROM usuarios';
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Get all records from table ordered by field
     *
     * @param $orderColumn column name
     */
    public function queryAllOrderBy($orderColumn) {
        $sql = 'SELECT * FROM usuarios ORDER BY ' . $orderColumn;
        $sqlQuery = new SqlQuery($sql);
        return $this->getList($sqlQuery);
    }

    /**
     * Delete record from table
     * @param usuario primary key
     */
    public function delete($idUsuario) {
        $sql = 'DELETE FROM usuarios WHERE idUsuario = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($idUsuario);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Insert record to table
     *
     * @param UsuariosMySql usuario
     */
    public function insert($usuario) {
        $sql = 'INSERT INTO usuarios (idTipoDocumento, documento, nombres, apellido1, apellido2, correo, clave) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($usuario->idTipoDocumento);
        $sqlQuery->set($usuario->documento);
        $sqlQuery->set($usuario->nombres);
        $sqlQuery->set($usuario->apellido1);
        $sqlQuery->set($usuario->apellido2);
        $sqlQuery->set($usuario->correo);
        $sqlQuery->set($usuario->clave);
        $id = $this->executeInsert($sqlQuery);
        $usuario->idUsuario = $id;
        return $id;
    }

    /**
     * Update record in table
     *
     * @param UsuariosMySql usuario
     */
    public function update($usuario) {
        $sql = 'UPDATE usuarios SET idTipoDocumento = ?, documento = ?, nombres = ?, apellido1 = ?, apellido2 = ?, correo = ?, clave = ? WHERE idUsuario = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($usuario->idTipoDocumento);
        $sqlQuery->set($usuario->documento);
        $sqlQuery->set($usuario->nombres);
        $sqlQuery->set($usuario->apellido1);
        $sqlQuery->set($usuario->apellido2);
        $sqlQuery->set($usuario->correo);
        $sqlQuery->set($usuario->clave);
        $sqlQuery->setNumber($usuario->idUsuario);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Delete all rows
     */
    public function clean() {
        $sql = 'DELETE FROM usuarios';
        $sqlQuery = new SqlQuery($sql);
        return $this->executeUpdate($sqlQuery);
    }

    public function queryByIdTipoDocumento($value) {
        $sql = 'SELECT * FROM usuarios WHERE idTipoDocumento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->getList($sqlQuery);
    }

    public function queryByDocumento($value) {
        $sql = 'SELECT * FROM usuarios WHERE documento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByNombres($value) {
        $sql = 'SELECT * FROM usuarios WHERE nombres = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByApellido1($value) {
        $sql = 'SELECT * FROM usuarios WHERE apellido1 = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByApellido2($value) {
        $sql = 'SELECT * FROM usuarios WHERE apellido2 = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByCorreo($value) {
        $sql = 'SELECT * FROM usuarios WHERE correo = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function queryByClave($value) {
        $sql = 'SELECT * FROM usuarios WHERE clave = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->getList($sqlQuery);
    }

    public function deleteByIdTipoDocumento($value) {
        $sql = 'DELETE FROM usuarios WHERE idTipoDocumento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->setNumber($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByDocumento($value) {
        $sql = 'DELETE FROM usuarios WHERE documento = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByNombres($value) {
        $sql = 'DELETE FROM usuarios WHERE nombres = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByApellido1($value) {
        $sql = 'DELETE FROM usuarios WHERE apellido1 = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByApellido2($value) {
        $sql = 'DELETE FROM usuarios WHERE apellido2 = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByCorreo($value) {
        $sql = 'DELETE FROM usuarios WHERE correo = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    public function deleteByClave($value) {
        $sql = 'DELETE FROM usuarios WHERE clave = ?';
        $sqlQuery = new SqlQuery($sql);
        $sqlQuery->set($value);
        return $this->executeUpdate($sqlQuery);
    }

    /**
     * Read row
     *
     * @return UsuariosMySql
     */
    protected function readRow($row) {
        $usuario = new Usuario();

        $usuario->idUsuario = $row['idUsuario'];
        $usuario->idTipoDocumento = $row['idTipoDocumento'];
        $usuario->documento = $row['documento'];
        $usuario->nombres = $row['nombres'];
        $usuario->apellido1 = $row['apellido1'];
        $usuario->apellido2 = $row['apellido2'];
        $usuario->correo = $row['correo'];
        $usuario->clave = $row['clave'];

        return $usuario;
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
     * @return UsuariosMySql
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

    public function listarUsuarios() {
        $query = "SELECT * FROM  usuarios ORDER BY nombres";
        return $this->conn->query($query);
    }

    public function insertar($usuario) {
        $query = "INSERT INTO usuarios (idtipodocumento,documento,nombres,apellido1,apellido2,correo,clave) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $usuario->getIdTipoDocumento());
        $stmt->bindparam(2, $usuario->getDocumento());
        $stmt->bindparam(3, $usuario->getNombres());
        $stmt->bindparam(4, $usuario->getApellido1());
        $stmt->bindparam(5, $usuario->getApellido2());
        $stmt->bindparam(6, $usuario->getCorreo());
        $stmt->bindparam(7, $usuario->getClave());
        return $stmt->execute();
    }

    public function obtenerUsuarioPorDocumento($doc) {
        $query = "SELECT idtipodocumento,documento,nombres,apellido1,apellido2,correo,clave"
                . " FROM usuarios WHERE documento='".$doc."'";
        return $this->conn->query($query);
    }

    public function obtenerUsuarioPorCorreo($correo) {
        $query = "SELECT idtipodocumento,documento,nombres,apellido1,apellido2,correo,clave"
                . " FROM usuarios WHERE correo='".$correo."'";
        return $this->conn->query($query);
    }

    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }
    
// Editar Usuarios
        public function updateTablaUsuarios($usuario) {
        $sql = 'UPDATE usuarios SET documento = ?, '
                . 'nombres = ?, apellido1 = ?, apellido2 = ?, clave = ? '
                . 'WHERE idUsuario = ?';
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
        
        
    }

}

?>