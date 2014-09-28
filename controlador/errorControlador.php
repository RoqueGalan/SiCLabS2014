<?php

class ErrorControlador extends Controlador {
    
    
    function __construct() {
        parent::__construct(); 
    }
    
    function index() {
        $this->_vista->titulo = '404 Error';
        $this->_vista->mensaje = 'Página no encontrada';

        $this->_vista->render('error/index', 'error');
  
    }
    
    function tipo($mensaje) {
        
        $errorLista = array(
            'PaginaNoExiste','Página no encontrada',
            'NoID','No coincide el ID',
            'RolNoExiste', 'El Rol no existe'
        );
        $this->_vista->titulo = 'Error';
        $this->_vista->mensaje = $errorLista[$mensaje];

        $this->_vista->render('error/index', 'error');
  
    }

}