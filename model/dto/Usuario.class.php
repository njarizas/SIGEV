<?php

/**
 * Object represents table 'usuarios'
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58	 
 */
class Usuario {

    private $idUsuario;
    private $idTipoDocumento;
    private $documento;
    private $nombres;
    private $apellido1;
    private $apellido2;
    private $correo;
    private $clave;
    private $ficha;
    private $rol;

    function __construct($idTipoDocumento, $documento, $nombres, $apellido1, $apellido2, $correo, $clave,$ficha,$rol) {
        $this->idTipoDocumento = $idTipoDocumento;
        $this->documento = $documento;
        $this->nombres = $nombres;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->ficha = $ficha;
        $this->rol = $rol;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    public function getIdTipoDocumento() {
        return $this->idTipoDocumento;
    }

    public function setIdTipoDocumento($idTipoDocumento) {
        $this->idTipoDocumento = $idTipoDocumento;
        return $this;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
        return $this;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
        return $this;
    }

    public function getDocumento() {
        return $this->documento;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
        return $this;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
        return $this;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
        return $this;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
        return $this;
    }

    function getFicha() {
        return $this->ficha;
    }

    function getRol() {
        return $this->rol;
    }

    function setFicha($ficha) {
        $this->ficha = $ficha;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

}