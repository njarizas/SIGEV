<?php
	/**
	 * Object represents table 'roles_permisos'
	 *
     	 * @author: http://phpdao.com
     	 * @date: 2016-07-24 18:58	 
	 */
	class RolPermiso{
		
		private $idPermiso;
		private $idRol;
                
                function __construct($idPermiso, $idRol) {
                    $this->idPermiso = $idPermiso;
                    $this->idRol = $idRol;
                }

                function getIdPermiso() {
                    return $this->idPermiso;
                }

                function getIdRol() {
                    return $this->idRol;
                }

                function setIdPermiso($idPermiso) {
                    $this->idPermiso = $idPermiso;
                }

                function setIdRol($idRol) {
                    $this->idRol = $idRol;
                }

		
	}
?>