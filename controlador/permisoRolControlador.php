<?php

class PermisoRolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($RolId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'permisoRol');
        $this->_vista->setJs('botonEstado', 'permisoRol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'PermisoRol-Lista';
        $RolId = $this->filtrarEntero($RolId);
        $rol = new Rol;
        $permisoRol = new PermisoRol();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Rol
        $rol->buscar($RolId);
        // comprobar que el registro exista
        if ($rol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //agregar rol a permisoRol
        $permisoRol->setRol($rol);
        //lista roles
        $this->_vista->listaPermisosRol = $paginador->paginar($permisoRol->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'permisoRol/index/' . $rol->getId());

        $this->_vista->render('permisoRol/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'PermisoRol-Mostrar';
        $this->_vista->permisoRol = new PermisoRol();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->permisoRol->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->permisoRol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("permisoRol/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'permisoRol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'PermisoRol-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->permisoRol = new PermisoRol();

        /* logica */
        $this->_vista->permisoRol->setId(0);
        $this->_vista->permisoRol->setEstado('');

        //llenar los select
        $this->_vista->listaRoles = $this->_vista->permisoRol->getRol()->lista();
        $this->_vista->listaPermisos = $this->_vista->permisoRol->getPermiso()->lista();

        $this->_vista->render('permisoRol/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'permisoRol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'PermisoRol-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->permisoRol = new PermisoRol();

        /* logica */
        $this->_vista->permisoRol->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->permisoRol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //llenar los select
        $this->_vista->listaRoles = $this->_vista->permisoRol->getRol()->lista();
        $this->_vista->listaPermisos = $this->_vista->permisoRol->getPermiso()->lista();

        $this->_vista->render('permisoRol/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);

        /* logica */
        // V A L I D A C I O N E S    D E L    F O R M U L A R I O
        // por php si javaScript no tuvo exito

        /*
         * Id:
         * Debe ser igual por Get y Post
         */
        if ($id != $this->getEntero('Id')) {
            $this->redireccionar('error/tipo/Registro_NoID');
        }
        $id = $this->getEntero('Id');

        /*
         * Select-Rol:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Rol';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Rol = $val->getValor($campo);

        /*
         * Select-Permiso:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Permiso';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Permiso = $val->getValor($campo);

        /*
         * Select-Permiso:
         * Requerido
         * Solo acepta: 'Activo', 'Inactivo'
         */
        $campo = 'Select_Estado';
        $val->requerido($campo);
        $val->compararPalabras($campo, $arreglo = array('Activo', 'Inactivo'));
        $select_Estado = $val->getValor($campo);


        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'permisoRol');
            // se encontraron errores
            $this->_vista->permisoRol = new PermisoRol();
            //asignar valores
            $this->_vista->permisoRol->setId($id);
            $this->_vista->permisoRol->getRol()->setId($select_Rol);
            $this->_vista->permisoRol->getPermiso()->setId($select_Permiso);
            $this->_vista->permisoRol->setEstado($select_Estado);
            //llenar los select
            $this->_vista->listaRoles = $this->_vista->permisoRol->getRol()->lista();
            $this->_vista->listaPermisos = $this->_vista->permisoRol->getPermiso()->lista();
            //redirigir a la vista
            $id ?
                            $this->_vista->render('permisoRol/editar') :
                            $this->_vista->render('permisoRol/nuevo');
        } else {
            // no se encontraron errores
            $permisoRol = new PermisoRol();

            $permisoRol->getRol()->setId($select_Rol);
            $permisoRol->getPermiso()->setId($select_Permiso);
            $permisoRol->setEstado($select_Estado);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
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
                $existe = $permisoRol->existe($select_Rol, $select_Permiso);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $permisoRol->setId($id);
                $permisoRol->actualizar();
            }
            $this->redireccionar('permisoRol/index/' . $permisoRol->getRol()->getID());
        }
    }

    function eliminar($id) {
        $permisoRol = new PermisoRol();
        $permisoRol->buscar($id);

        // comprobar que el registro exista
        if ($permisoRol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $permisoRol->eliminar($id);
        $this->redireccionar('permisoRol/index/' . $permisoRol->getRol()->getID());
    }

    function _comprobarPermisoRol() {
        $esDisponible = false;
        $permiso = $this->getEntero('Select_Permiso');
        $rol = $this->getEntero('Select_Rol');
        //validar que permiso y rol no esten asignados aun rol

        $permisoRol = new PermisoRol();
        if ($permisoRol->existe($rol, $permiso)) {
            $esDisponible = false;
        } else {
            $esDisponible = true;
        }

        if($rol == 0) $esDisponible = false;
        

        echo json_encode(array('valid' => $esDisponible));
    }

}
