<?php
	/**
	 * Object represents table 'usuarios'
	 *
     	 * @author: http://phpdao.com
     	 * @date: 2016-07-24 18:58	 
	 */
	class Usuario{
		private $idUsuario;
		private $idTipoDocumento;
		private $documento;
		private $nombres;
		private $apellido1;
		private $apellido2;
		private $correo;
		private $clave;
                
                function __construct($idTipoDocumento, $documento, $nombres, $apellido1, $apellido2, $correo, $clave) {
                    $this->idTipoDocumento = $idTipoDocumento;
                    $this->documento = $documento;
                    $this->nombres = $nombres;
                    $this->apellido1 = $apellido1;
                    $this->apellido2 = $apellido2;
                    $this->correo = $correo;
                    $this->clave = $clave;
                }

                function getIdUsuario() {
                    return $this->idUsuario;
                }

                function getIdTipoDocumento() {
                    return $this->idTipoDocumento;
                }

                function getDocumento() {
                    return $this->documento;
                }

                function getNombres() {
                    return $this->nombres;
                }

                function getApellido1() {
                    return $this->apellido1;
                }

                function getApellido2() {
                    return $this->apellido2;
                }

                function getCorreo() {
                    return $this->correo;
                }

                function getClave() {
                    return $this->clave;
                }

                function setIdUsuario($idUsuario) {
                    $this->idUsuario = $idUsuario;
                }

                function setIdTipoDocumento($idTipoDocumento) {
                    $this->idTipoDocumento = $idTipoDocumento;
                }

                function setDocumento($documento) {
                    $this->documento = $documento;
                }

                function setNombres($nombres) {
                    $this->nombres = $nombres;
                }

                function setApellido1($apellido1) {
                    $this->apellido1 = $apellido1;
                }

                function setApellido2($apellido2) {
                    $this->apellido2 = $apellido2;
                }

                function setCorreo($correo) {
                    $this->correo = $correo;
                }

                function setClave($clave) {
                    $this->clave = $clave;
                }

         
	}
?>