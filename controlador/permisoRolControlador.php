<?php

class PermisoRolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($RolId, $pagina = false) {
        //preparar el paginador
        if (!$this->filtrarEntero($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }

        $RolId = $this->filtrarEntero($RolId);
        //lista de permisos
        $this->_vista->titulo = 'PermisoRol-Lista';

        $rol = new Rol;
        $rol->buscar($RolId); // buscar el Rol
        //verificar que el rol exista
        if ($rol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $paginador = new Paginador();

        $permisoRol = new PermisoRol();
        $permisoRol->setRol($rol);


        $this->_vista->listaPermisosRol = $paginador->paginar($permisoRol->lista(), $pagina, 10);
        $this->_vista->paginacion = $paginador->getVista('prueba', 'permisoRol/index/' . $rol->getId());

        $this->_vista->render('permisoRol/index');
    }

    function mostrar($Id) {
        //mostrar 
        $this->_vista->titulo = 'PermisoRol-Mostrar';
        $this->_vista->permisoRol = new PermisoRol();
        $this->_vista->permisoRol->buscar($Id);

        //verificar que exista
        if ($this->_vista->permisoRol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
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
            $this->redireccionar('error/tipo/Registro_NoExiste');
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
            $this->redireccionar('error/tipo/Registro_NoID');
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

            if ($id == 0) {
                $this->_vista->render('permisoRol/nuevo');
            } else {
                $this->_vista->render('permisoRol/editar');
            }
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
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                

                $permisoRol->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($permisoRol->existe($select_Rol, $select_Permiso) != $id) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $permisoRol->setId($id);
                $permisoRol->actualizar();
            }

            $this->index($permisoRol->getRol()->getID());
        }
    }

    function eliminar($id) {
        $permisoRol = new PermisoRol();
        $permisoRol->eliminar($id);
        $this->index();
    }

}
