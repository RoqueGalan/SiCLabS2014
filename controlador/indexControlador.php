<?php

class IndexControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
        $this->vista->titulo = 'Home';
        $this->vista->mensaje = "Estas en la página principal";
        
      
        $this->vista->render('index/index');
       
    }
    
}