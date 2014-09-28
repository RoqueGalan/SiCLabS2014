<?php

class RolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //lista de los roles
        $this->_vista->titulo = 'Rol';

        $rol = new Rol();

        $this->_vista->listaRoles = $rol->lista();
        $this->_vista->render('rol/index');
    }

    function mostrar($id) {
        $rol = new Rol();
        $rol = $rol->buscar($id);

        $this->_vista->rol = $rol;

        $this->_vista->render("rol/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'Rol-Nuevo';

        $this->_vista->rol = new Rol();
        $this->_vista->rol->setId(0);

        $this->_vista->render('rol/nuevo');
    }

    function editar($id) {
        $this->_vista->titulo = 'Rol-Editar';

        $this->_vista->rol = new Rol();
        $this->_vista->rol->buscar($id);

        if (empty($this->_vista->rol)) {
            header('location:' . ROOT . 'error/tipo/RolNoExiste');
        }

        $this->_vista->render('rol/editar');
    }

    function _guardar($id) {
        $this->_vista->listaError = array();

        /*
         * realizar las validaciones
         * si todo esta correcto ACTUALIZAR
         * si no entonces devolver los valores a la vista EDITAR o NUEVO
         */

        /*
         * validar Id por Get y Post
         */
        if ($id != $this->getEntero('Id')) {
            //error faltal
            header('location:' . ROOT . 'error/tipo/NoID');
        }

        /*
         * Validar Nombre:
         * No Nulo
         * Alfanumerico
         */
        
        $id = $this->getEntero('Id');
        $nombre = $this->getTexto('Nombre');

        if (empty($nombre)) {
            $this->_vista->listaError[] = 'Nombre Esta Vacio';
        }

        /*
         * Existen Errores
         */
        if (count($this->_vista->listaError)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado a la vista editar
             */

            $this->_vista->rol = new Rol();
            $this->_vista->rol->setId($id);
            $this->_vista->rol->setNombre($nombre);

            $this->_vista->render('rol/editar');
        } else {

            //aplicar patron Factory

            //if id == 0 entonces insertar
            //si no entonces actualziar
            
            $rol = new Rol();
            $rol->setNombre($nombre);

            if($id == 0){
                $rol->insertar();
            }else{
                $rol->setId($id);
                $rol->actualizar();
            }
            

            $this->index();
        }
    }
    
    

    function _eliminar($id) {
        
    }

}
