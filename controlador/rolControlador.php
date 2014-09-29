<?php

class RolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //lista de los roles
        $this->_vista->titulo = 'Rol-Lista';
        $rol = new Rol();

        $this->_vista->listaRoles = $rol->lista();
        $this->_vista->render('rol/index');
    }

    function mostrar($Id) {
        //mostrar 
        $this->_vista->titulo = 'Rol-Mostrar';
        $this->_vista->rol = new Rol();
        $this->_vista->rol->buscar($Id);

        //verificar que exista
        if ($this->_vista->rol->getId() == -1) {
            header('location:' . ROOT . 'error/tipo/Registro_NoExiste');
            die;
        }

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

        //verificar que exista
        if ($this->_vista->rol->getId() == -1) {
            header('location:' . ROOT . 'error/tipo/Registro_NoExiste');
            die;
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
            header('location:' . ROOT . 'error/tipo/Registro_NoID');
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
             * al encontrar errores hay que redirigir lo ingresado al formulario
             */

            $this->_vista->rol = new Rol();
            $this->_vista->rol->setId($id);
            $this->_vista->rol->setNombre($nombre);

            
            if ($id == 0) {
                $this->_vista->render('rol/nuevo');
            } else {
                $this->_vista->render('rol/editar');
            }
            
        } else {

            //aplicar patron Factory
            //if id == 0 entonces insertar
            //si no entonces actualziar

            $rol = new Rol();
            $rol->setNombre($nombre);

            if ($id == 0) {
                
                //insertar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($rol->existe($id)) {
                    header('location:' . ROOT . 'error/tipo/Registro_SiExiste');
                    die;
                }
                
                $rol->insertar();
            } else {
                //actualizar
                $rol->setId($id);
                $rol->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $rol = new Rol();
        $rol->eliminar($id);
        $this->index();
    }

}
