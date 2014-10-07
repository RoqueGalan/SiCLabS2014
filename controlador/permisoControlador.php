<?php

class PermisoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'Rol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Permiso-Lista';
        $permiso = new Permiso();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista permisos
        $this->_vista->listaPermisos = $paginador->paginar($permiso->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'permiso/index');

        $this->_vista->render('permiso/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Permiso-Mostrar';
        $this->_vista->permiso = new Permiso();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->permiso->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->permiso->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("permiso/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'permiso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Permiso-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->permiso = new Permiso();

        /* logica */
        $this->_vista->permiso->setId(0);

        $this->_vista->render('permiso/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'permiso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Permiso-Editar';
        $this->_vista->errorForm = array();
        $this->_vista->permiso = new Permiso();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->permiso->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->permiso->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('permiso/editar');
    }

    function _guardar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'permiso');

        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);

        /* logica */
        // V A L I D A C I O N E S    D E L    F O R M U L A R I O
        // por php si javaScript no tuvo exito

        /*
         * Id:
         *      Debe ser igual por Get y Post
         */
        if ($id != $this->getEntero('Id')) {
            $this->redireccionar('error/tipo/Registro_NoID');
        }
        $id = $this->getEntero('Id');

        /*
         * Nombre:
         *      Requerido
         *      Rango (2,128)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->cadenaRango($campo, 2, 128, 1);
        $nombre = $val->getValor($campo);

        /*
         * Descripcion:
         *      Requerido
         *      Rango (2,512)
         */
        $campo = 'Descripcion';
        $val->requerido($campo);
        $val->cadenaRango($campo, 2, 512, 1);
        $descripcion = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            $this->_vista->permiso = new Permiso();

            $this->_vista->permiso->setId($id);
            $this->_vista->permiso->setNombre($nombre);
            $this->_vista->permiso->setDescripcion($descripcion);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('permiso/editar') :
                            $this->_vista->render('permiso/nuevo');
        } else {

            //aplicar patron Factory
            //if id == 0 entonces insertar
            //si no entonces actualziar

            $permiso = new Permiso();
            $permiso->setNombre($nombre);
            $permiso->setDescripcion($descripcion);

            if ($id == 0) {
                //insertar
                // No repetido
                if ($permiso->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $permiso->insertar();
            } else {
                //actualizar
                // No repetido
                $existe = $permiso->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $permiso->setId($id);
                $permiso->actualizar();
            }
            $this->index();
        }
    }

    function eliminar($id) {
        $permiso = new Permiso();
        $permiso->eliminar($id);
        $this->index();
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $permiso = new Permiso();

            $permiso->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
