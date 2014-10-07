<?php

class RolControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'Rol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Rol-Lista';
        $rol = new Rol();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista roles
        $this->_vista->listaRoles = $paginador->paginar($rol->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'rol/index');

        $this->_vista->render('rol/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Rol-Mostrar';
        $this->_vista->rol = new Rol();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->rol->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->rol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("rol/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'rol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Rol-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->rol = new Rol();

        /* logica */
        $this->_vista->rol->setId(0);

        $this->_vista->render('rol/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'rol');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Rol-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->rol = new Rol();

        /* logica */
        $this->_vista->rol->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->rol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('rol/editar');
    }

    function _guardar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'rol');

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
         * Nombre
         * Requerido
         * Letras
         * Rango (4,32)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->letras($campo);
        $val->cadenaRango($campo, 4, 32, 1);
        $nombre = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            $this->_vista->rol = new Rol();

            $this->_vista->rol->setId($id);
            $this->_vista->rol->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('rol/editar') :
                            $this->_vista->render('rol/nuevo');
        } else {
            // no se encontraron errores
            $rol = new Rol();
            $rol->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                echo 'insertar';
                if ($rol->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $rol->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                $existe = $rol->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

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

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $rol = new Rol();

            $rol->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
