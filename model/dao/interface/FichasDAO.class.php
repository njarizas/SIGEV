<?php

/**
 *
 * @author Nelson
 */
require_once 'DAO.php';

interface FichasDAO extends DAO {
    
    public function insertar($ficha);
    
}
