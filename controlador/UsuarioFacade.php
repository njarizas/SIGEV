<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioFacade
 *
 * @author ADMIN
 */
class UsuarioFacade {
    private $usuarioDao;
    private $emailServicesImp;
    
    function __construct() {
        $this->usuarioDao= new UsuariosMySqlDAO();
        $this->emailServiceImp = new EmailServicesImp();
    }

    function registrarUsuario($usuario) {
        $resultado = 0;
        
        $resultado=$this->usuarioDao->insertar($usuario);
        if ($resultado === 0) {
            
        }else {
            $this->emailServicesImp->enviarCorreo($usuario->getCorreo());
        }
        return 'Registro Exitoso, verifique su correo';
    }
    function envioMasivo() {
       $listeCorreos;
       $listeCorreos=$this->usuarioDao->listarUsuarios();
       $this->emailServicesImp->enviarMasivo($listeCorreos);
       foreach ($listeCorreos as $correo){
           
           
           
           
       }
        
        
    }
}
