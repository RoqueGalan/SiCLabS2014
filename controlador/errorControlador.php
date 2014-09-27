<?php

class ErrorControlador extends Controlador {

    function __construct() {
        parent::__construct(); 
    }
    
    function index() {
        $this->vista->titulo = '404 Error';
        $this->vista->mensaje = 'Esta Pagina No Existe';

        $this->vista->render('error/index', 'error');
  
    }

}