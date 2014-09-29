<?php

class PermisoRolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($RolId = 1) {
        //lista de permisos
        $this->_vista->titulo = 'Permiso-Rol';

        $rol = new Rol;
        $rol->buscar($RolId); // buscar administrador
        $permisoRol = new PermisoRol();
        $permisoRol->setRol($rol);

        $this->_vista->listaPermisosRol = $permisoRol->lista();

        $this->_vista->render('permisoRol/index');
    }

    function mostrar($Id) {
        //mostrar 
        $this->_vista->titulo = 'PermisoRol-Mostrar';
        $this->_vista->permisoRol = new PermisoRol();
        $this->_vista->permisoRol = $this->_vista->permisoRol->buscar($Id);


        //verificar que exista
        if ($this->_vista->permisoRol->getId() == -1) {
            header('location:' . ROOT . 'error/tipo/Registro_NoExiste');
            die;
        }

        $this->_vista->render("permisoRol/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'PermisoRol-Nuevo';

        $this->_vista->permisoRol = new PermisoRol();
        $this->_vista->permisoRol->setId(0);
        $this->_vista->permisoRol->setEstado('error');

        $this->_vista->listaRoles = $this->_vista->permisoRol->getRol()->lista();
        $this->_vista->listaPermisos = $this->_vista->permisoRol->getPermiso()->lista();

        $this->_vista->render('permisoRol/nuevo');
    }

    function editar($Id) {
        $this->_vista->titulo = 'PermisoRol-Editar';

        $this->_vista->permisoRol = new PermisoRol();
        $this->_vista->permisoRol->buscar($Id);

        //verificar que exista
        if ($this->_vista->permisoRol->getId() == -1) {
            header('location:' . ROOT . 'error/tipo/Registro_NoExiste');
            die;
        }

        $this->_vista->listaRoles = $this->_vista->permisoRol->getRol()->lista();
        $this->_vista->listaPermisos = $this->_vista->permisoRol->getPermiso()->lista();

        $this->_vista->render('permisoRol/editar');
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
         * Evita posibles ataques a la seguridad
         */
        if ($id != $this->getEntero('Id')) {
            //error faltal
            header('location:' . ROOT . 'error/tipo/Registro_NoID');
            die;
        }
        $id = $this->getEntero('Id');

        /*
         * Validar Select-Rol:
         * No Select
         */
        $select_Rol = $this->getEntero('Select-Rol');
        if ($select_Rol == 0) {
            $this->_vista->listaError[] = 'Seleccione un rol';
        }

        /*
         * Validar Select-Permiso:
         * No Select
         */
        $select_Permiso = $this->getEntero('Select-Permiso');
        if ($select_Permiso == 0) {
            $this->_vista->listaError[] = 'Seleccione un permiso';
        }

        /*
         * Validar Select-Estado:
         * No Select
         */
        $select_Estado = $this->getTexto('Select-Estado');

        if ($select_Estado == 'error') {
            $this->_vista->listaError[] = 'Seleccione un estado para el permiso';
        }

        /*
         * Existen Errores
         */
        if (count($this->_vista->listaError)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado al formilario
             */

            $this->_vista->permisoRol = new PermisoRol();
            $this->_vista->permisoRol->setId($id);
            $this->_vista->permisoRol->getRol()->setId($select_Rol);
            $this->_vista->permisoRol->getPermiso()->setId($select_Permiso);
            $this->_vista->permisoRol->setEstado($select_Estado);

            $this->_vista->listaRoles = $this->_vista->permisoRol->getRol()->lista();
            $this->_vista->listaPermisos = $this->_vista->permisoRol->getPermiso()->lista();


            $this->_vista->render('permisoRol/editar');
        } else {


            //aplicar patron Factory
            //if id == 0 entonces insertar
            //si no entonces actualziar

            $permisoRol = new PermisoRol();
            $permisoRol->getRol()->setId($select_Rol);
            $permisoRol->getPermiso()->setId($select_Permiso);
            $permisoRol->setEstado($select_Estado);


            if ($id == 0) {
                //insertar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($permisoRol->existe($select_Rol, $select_Permiso)) {
                    header('location:' . ROOT . 'error/tipo/Registro_SiExiste');
                    die;
                }

       
                $permisoRol->insertar();
            } else {
                //actualizar
                $permisoRol->setId($id);
               
                $permisoRol->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $accion = new PermisoRol();
        $accion->eliminar($id);
        $this->index();
    }
}
