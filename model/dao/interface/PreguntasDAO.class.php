<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once 'DAO.php';

interface PreguntasDAO extends DAO {

    public function insertar($preguntaDTO);
    
    public function buscarPreguntasPorCurso($idCurso);
}
