<?php
	/**
	 * Object represents table 'usuarios_roles'
	 *
     	 * @author: http://phpdao.com
     	 * @date: 2016-07-24 18:58	 
	 */
	class UsuarioRol{
		
		private $idUsuario;
		private $idRol;
                
                function __construct($idUsuario, $idRol) {
                    $this->idUsuario = $idUsuario;
                    $this->idRol = $idRol;
                }

                function getIdUsuario() {
                    return $this->idUsuario;
                }

                function getIdRol() {
                    return $this->idRol;
                }

                function setIdUsuario($idUsuario) {
                    $this->idUsuario = $idUsuario;
                }

                function setIdRol($idRol) {
                    $this->idRol = $idRol;
                }

		
	}
?>