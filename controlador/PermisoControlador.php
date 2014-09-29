<?php

class PermisoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //lista de permisos
        $this->_vista->titulo = 'Permiso';

        $permiso = new Permiso();

        $this->_vista->listaPermisos = $permiso->lista();
        $this->_vista->render('permiso/index');
    }

    function mostrar($id) {
        //mostrar 
        $this->_vista->titulo = 'Permiso-Nuevo';
        $permiso = new Permiso();
        $permiso = $permiso->buscar($id);

        $this->_vista->permiso = $permiso;

        $this->_vista->render("permiso/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'Permiso-Nuevo';

        $this->_vista->permiso = new Permiso();
        $this->_vista->permiso->setId(0);

        $this->_vista->render('permiso/nuevo');
    }

    function editar($id) {
        $this->_vista->titulo = 'Permiso-Editar';

        $this->_vista->permiso = new Permiso();
        $this->_vista->permiso->buscar($id);

        if (empty($this->_vista->permiso)) {
            header('location:' . ROOT . 'error/tipo/PermisoNoExiste');
        }

        $this->_vista->render('permiso/editar');
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
        $id = $this->getEntero('Id');
        
        /*
         * Validar Nombre:
         * No Nulo
         * Alfanumerico
         */
        $nombre = $this->getTexto('Nombre');

        if (empty($nombre)) {
            $this->_vista->listaError[] = 'Nombre Esta Vacio';
        }
        
        /*
         * Validar Descripcion:
         * No Nulo
         * Alfanumerico
         */
        $descripcion = $this->getTexto('Descripcion');

        if (empty($descripcion)) {
            $this->_vista->listaError[] = 'Descripcion Esta Vacio';
        }

        /*
         * Existen Errores
         */
        if (count($this->_vista->listaError)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado a la vista editar
             */

            $this->_vista->permiso = new Permiso();
            $this->_vista->permiso->setId($id);
            $this->_vista->permiso->setNombre($nombre);
            $this->_vista->permiso->setDescripcion($descripcion);

            $this->_vista->render('permiso/editar');
        } else {

            //aplicar patron Factory

            //if id == 0 entonces insertar
            //si no entonces actualziar
            
            $permiso = new Permiso();
            $permiso->setNombre($nombre);
            $permiso->setDescripcion($descripcion);

            if($id == 0){
                $permiso->insertar();
            }else{
                $permiso->setId($id);
                $permiso->actualizar();
            }

            $this->index();
        }
    }
    
    

    function _eliminar($id) {
        
    }

}
