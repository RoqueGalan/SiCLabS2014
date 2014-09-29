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
            'Pagina_NoExiste' => 'La Página no se puede Mostrar ó No Existe.',
            'Desconocido' => 'Error Desconocido.',
            'Registro_NoID' => 'Error Desconocido en el ID.',
            'Registro_NoExiste' => 'El Registro No Existe.',
            'Registro_SiExiste' => 'El Registro esta Repetido.'
        );
        
        if (isset($errorLista[$mensaje])){
            $this->_vista->titulo = 'Error';
            $this->_vista->mensaje = $errorLista[$mensaje];    
            
        }else{
            header('location:' . ROOT . 'error/');
            exit;
        }
            
        $this->_vista->render('error/index', 'error');
    }
}
