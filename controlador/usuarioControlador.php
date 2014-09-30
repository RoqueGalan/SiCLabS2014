<?php

class UsuarioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //lista de usuarios
        $this->_vista->titulo = 'Usuario-Lista';
        $usuario = new Usuario();

        $this->_vista->listaUsuarios = $usuario->lista();
        $this->_vista->render('usuario/index');
    }
    
    function mostrar($Matricula) {
        //mostrar 
        $this->_vista->titulo = 'Usuario-Mostrar';
        $this->_vista->usuario = new Usuario();
        $this->_vista->usuario->buscar($Matricula);

        //verificar que existia
        if ($this->_vista->rol->getMatricula() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("usuario/mostrar");
    }
    
    
    function nuevo() {
        $this->_vista->titulo = 'Usuario-Nuevo';

        $this->_vista->usuario = new Usuario();
        $this->_vista->usuario->setMatricula('0');

        $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();
        
        $this->_vista->render('usuario/nuevo');

    }
}

