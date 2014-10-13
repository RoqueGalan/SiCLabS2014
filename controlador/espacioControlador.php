<?php

class EspacioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'Espacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Espacio-Lista';
        $espacio = new Espacio();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista Espacio
        $this->_vista->listaEspacios = $paginador->paginar($espacio->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'espacio/index');

        $this->_vista->render('espacio/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Espacio-Mostrar';
        $this->_vista->espacio = new Espacio();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->espacio->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->espacio->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("espacio/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'espacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Espacio-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->espacio = new Espacio();

        /* logica */
        $this->_vista->espacio->setId(0);
        // lista de tipos espacios
        $this->_vista->listaTiposEspacio = $this->_vista->espacio->getTipoEspacio()->lista();

        $this->_vista->render('espacio/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'espacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Espacio-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->espacio = new Espacio();

        /* logica */
        $this->_vista->espacio->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->espacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de tipo espacio
        $this->_vista->listaTiposEspacio = $this->_vista->espacio->getTipoEspacio()->lista();

        $this->_vista->render('espacio/editar');
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
         * Nombre (s)
         * Requerido
         * Letras
         * Rango (1,128)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->letras($campo);
        $val->cadenaRango($campo, 1, 128, 1);
        $nombre = $val->getValor($campo);

        /*
         * Descripcion
         * Letras y Numeros
         */
        $campo = 'Descripcion';
        $val->alfanumerico($campo);
        $descripcion = $val->getValor($campo);

        /*
         * Select_TipoEspacio:
         * Requerido
         * Numerico
         */
        $campo = 'Select_TipoEspacio';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_TipoEspacio = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'espacio');

            $this->_vista->espacio = new Espacio();

            $this->_vista->espacio->setId($id);
            $this->_vista->espacio->setNombre($nombre);
            $this->_vista->espacio->setDescripcion($descripcion);
            $this->_vista->espacio->getTipoEspacio()->setId($select_TipoEspacio);

            //lista de tipo espacio
            $this->_vista->listaTiposEspacio = $this->_vista->espacio->getTipoEspacio()->lista();


            //redirigir a la vista
            $id ?
                            $this->_vista->render('espacio/editar') :
                            $this->_vista->render('espacio/nuevo');
        } else {
            // no se encontraron errores
            $espacio = new Espacio();

            $espacio->setNombre($nombre);
            $espacio->setDescripcion($descripcion);
            $espacio->getTipoEspacio()->setId($select_TipoEspacio);

            if ($id == 0) {
                //insertar
                $espacio->insertar();
            } else {
                //actualizar
                $espacio->setId($id);
                $espacio->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $espacio = new Espacio();
        $espacio->buscar($id);

        // comprobar que el registro exista
        if ($espacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $espacio->eliminar($id);
        $this->redireccionar('espacio/index/');
    }

}
