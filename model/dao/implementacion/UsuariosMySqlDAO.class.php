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

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }

    public function listarTodos() {
        $query = "SELECT * FROM  usuarios ORDER BY nombres";
        return $this->conn->query($query);
    }

    public function insertar($usuario) {
        $query = "INSERT INTO usuarios (idtipodocumento,documento,nombres,apellido1,apellido2,correo,clave,ficha,rol) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $usuario->getIdTipoDocumento());
        $stmt->bindparam(2, $usuario->getDocumento());
        $stmt->bindparam(3, $usuario->getNombres());
        $stmt->bindparam(4, $usuario->getApellido1());
        $stmt->bindparam(5, $usuario->getApellido2());
        $stmt->bindparam(6, $usuario->getCorreo());
        $stmt->bindparam(7, $usuario->getClave());
        $stmt->bindparam(8, $usuario->getFicha());
        $stmt->bindparam(9, $usuario->getRol());
        return $stmt->execute();
    }

    public function obtenerUsuarioPorDocumento($doc) {
        $query = "SELECT idtipodocumento,documento,nombres,apellido1,apellido2,correo,clave,ficha,rol"
                . " FROM usuarios WHERE documento='" . $doc . "'";
        return $this->conn->query($query);
    }

    public function obtenerUsuarioPorCorreo($correo) {
        $query = "SELECT idtipodocumento,documento,nombres,apellido1,apellido2,correo,clave,ficha,rol"
                . " FROM usuarios WHERE correo='" . $correo . "'";
        return $this->conn->query($query);
    }

    public function actualizarUsuario($usuario) {
        $sql = 'UPDATE usuarios SET documento = ?, '
                . 'nombres = ?, apellido1 = ?, apellido2 = ?, clave = ? '
                . 'WHERE idUsuario = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam($usuario->setDocumento());
        $stmt->bindparam($usuario->setNombres());
        $stmt->bindparam($usuario->setApellido1());
        $stmt->bindparam($usuario->setApellido2());
        $stmt->bindparam($usuario->setClave());
        return $stmt->execute();
    }

    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }

}
