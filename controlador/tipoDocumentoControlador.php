<?php

class TipoDocumentoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'tipoDocumento');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoDocumento-Lista';
        $tipoDocumento = new TipoDocumento();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista Tipo Espacio
        $this->_vista->listaTiposDocumentos = $paginador->paginar($tipoDocumento->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'tipoDocumento/index');

        $this->_vista->render('tipoDocumento/index');
    }

    function mostrar($Id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoDocumento-Mostrar';
        $this->_vista->tipoDocumento = new TipoDocumento();

        /* logica */
        $this->_vista->tipoDocumento->buscar($Id);

        // comprobar que el registro exista
        if ($this->_vista->tipoDocumento->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("tipoDocumento/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'tipoDocumento');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoDocumento-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->tipoDocumento = new TipoDocumento();

        /* logica */
        $this->_vista->tipoDocumento->setId(0);

        $this->_vista->render('tipoDocumento/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'tipoDocumento');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoDocumento-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->tipoDocumento = new TipoDocumento();

        /* logica */
        $this->_vista->tipoDocumento->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->tipoDocumento->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('tipoDocumento/editar');
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
         * Rango (2,32)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->letras($campo);
        $val->cadenaRango($campo, 2, 32, 1);
        $nombre = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'tipoDocumento');

            $this->_vista->tipoDocumento = new TipoDocumento();

            $this->_vista->tipoDocumento->setId($id);
            $this->_vista->tipoDocumento->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('tipoDocumento/editar') :
                            $this->_vista->render('tipoDocumento/nuevo');
        } else {
            // no se encontraron errores
            $tipoDocumento = new TipoDocumento();

            $tipoDocumento->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                if ($tipoDocumento->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $tipoDocumento->insertar();
            } else {
                //actualizar
                // comprobar campo Nombre no repetido
                $existe = $tipoDocumento->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $tipoDocumento->setId($id);
                $tipoDocumento->actualizar();
            }

            $this->redireccionar('tipoDocumento/index/');
        }
    }

    function eliminar($id) {
        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->buscar($id);

        // comprobar que el registro exista
        if ($tipoDocumento->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $tipoDocumento->eliminar($id);
        $this->redireccionar('tipoDocumento/index/');
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $tipodocumento = new TipoDocumento();

            $tipodocumento->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
