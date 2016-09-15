<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once 'DAO.php';

interface UsuariosDAO extends DAO {

    public function insertar($usuario);

    public function obtenerUsuarioPorDocumento($doc);

    public function obtenerUsuarioPorCorreo($correo);

    public function actualizarUsuario($usuario);

    public function listarEstudiantes();

    public function listarProfesores();

    public function listarAdministrativos();
}
