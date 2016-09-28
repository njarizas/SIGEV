<?php

/**
 * Class that operate on table 'resultadosexamenes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once '../class/config/Database.class.php';
require_once '../model/dao/interface/ResultadosExamenesDAO.class.php';

class ResultadosExamenesMySqlDAO implements ResultadosExamenesDAO {

    private $conn;

    function __construct() {
        $this->conn = Database::connect();
    }
    
    public function existeResultadoParaUsuarioYExamen ($idExamen,$estudiante){
    	$query = "SELECT * FROM resultadosexamenes where idexamen=?,idusuario=?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindparam(1, $idExamen);
    	$stmt->bindparam(2, $estudiante);
    	$stmt->execute();
    	$rows = $stmt->fetchAll();
    	if (count($rows)!=0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    
	public function listarExamenPorIdUsuarioYExamen($idExamen,$idUsuario){
		$query = "SELECT * FROM resultadosexamenes where idexamen=?,idusuario=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $idExamen);
		$stmt->bindparam(2, $idUsuario());
		return $stmt->execute();
	}
    public function insertar($resultadoExamen) {
        $query = "INSERT INTO resultadosexamenes (idestudiante,idexamen,nota) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(1, $resultadoExamen->getIdEstudiante());
        $stmt->bindparam(2, $resultadoExamen->getIdExamen());
        $stmt->bindparam(3, $resultadoExamen->getNota());
        return $stmt->execute();
    }

    public function listarTodos() {
        $query = "SELECT * FROM  resultadosexamenes ORDER BY idresultadoexamen";
        return $this->conn->query($query);
    }

    public function obtenerUltimoRegistroInsertado() {
        $query = "SELECT * FROM resultadosexamenes ORDER BY idresultadoexamen DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
//        echo 'El id del ultimo registro insertado es '.$row['idexamen'];
        return $row;
    }

    function getConn() {
        return $this->conn;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}
