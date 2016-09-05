<?php

/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-07-24 18:58
 */
require_once 'DAO.php';

interface TiposDocumentoDAO extends DAO{
      function insertar($nombreDocumento);
}
