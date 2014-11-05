<?php

class documentoEspacioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($EspacioId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'documentoEspacio');
        $this->_vista->setJs('abrirDocumentoPop');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'DocumentoEspacio-Lista';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $documentoEspacio = new DocumentoEspacio();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Rol
        $documentoEspacio->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($documentoEspacio->getEspacio()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->espacio = $documentoEspacio->getEspacio()->getId();
        //lista 
        $this->_vista->listaDocumentos = $paginador->paginar($documentoEspacio->lista($EspacioId), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'documentoEspacio/index/' . $documentoEspacio->getEspacio()->getId());

        $this->_vista->render('documentoEspacio/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'DocumentoEspacio-Mostrar';
        $this->_vista->documento = new DocumentoEspacio();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->documento->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->documento->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("documentoEspacio/mostrar");
    }

    function nuevo($EspacioId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'documentoEspacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'DocumentoEspacio-Nuevo';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $this->_vista->errorForm = array();
        $this->_vista->documento = new DocumentoEspacio();

        /* logica */
        $this->_vista->documento->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($this->_vista->documento->getEspacio()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->documento->setId(0);

        // lista
        $this->_vista->listaTiposDocumento = $this->_vista->documento->getTipoDocumento()->lista();

        $this->_vista->render('documentoEspacio/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'documentoEspacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'DocumentoEspacio-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->documento = new DocumentoEspacio();

        /* logica */
        $this->_vista->documento->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->documento->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista
        $this->_vista->listaTiposDocumento = $this->_vista->documento->getTipoDocumento()->lista();

        $this->_vista->render('documentoEspacio/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $documento = new DocumentoEspacio();

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
         * Documento:
         * Requerido
         * *Todo tipo de documentos
         */
        $campo = 'Documento';
        $archivo = $val->archivo($campo, $documento->getRuta(), true);

        /*
         * EspacioId
         * Numerico
         */
        $campo = 'EspacioId';
        $val->requerido($campo);
        $val->numerico($campo);
        $espacioId = $val->getValor($campo);

        /*
         * Select_TipoDocumento:
         * Requerido
         * Numerico
         */
        $campo = 'Select_TipoDocumento';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_TipoDocumento = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'documentoEspacio');

            $this->_vista->documento = new DocumentoEspacio();

            $this->_vista->documento->setId($id);
            $this->_vista->documento->getTipoDocumento()->setId($select_TipoDocumento);
            $this->_vista->documento->getEspacio()->setId($espacioId);

            //lista
            $this->_vista->listaTiposDocumento = $this->_vista->documento->getTipoDocumento()->lista();

            //redirigir a la vista
            $id ?
                            $this->_vista->render("documentoEspacio/editar") :
                            $this->_vista->render("documentoEspacio/nuevo");
        } else {
            // no se encontraron errores
            $documento->getTipoDocumento()->setId($select_TipoDocumento);
            $documento->getEspacio()->setId($espacioId);
            $documento->setDocumento($this->getTexto('DocumentoDefault'));

            // si FILE lleno
            if ($archivo == 1) {
                //eliminar los archivos para no dejar rastros
                @unlink(DIR_ROOT . $documento->getRuta() . $documento->getDocumento());
                $documento->setDocumento($this->subirArchivo('Documento', $documento->getRuta()));
            }

            if ($id == 0) {
                //insertar
                $documento->insertar();
            } else {
                //actualizar
                $documento->setId($id);

                $documento->actualizar();
            }
            $this->redireccionar('documentoEspacio/index/' . $espacioId);
        }
    }

    function eliminar($id) {
        $documento = new DocumentoEspacio();
        $documento->buscar($id);

        // comprobar que el registro exista
        if ($documento->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $documento->eliminar($id);
        //eliminar los archivos del disco
        @unlink(DIR_ROOT . $documento->getRuta() . $documento->getDocumento());

        $this->redireccionar('documentoEspacio/index/' . $documento->getEspacio()->getId());
    }

    function _comprobarDocumentoEspacio($espacioId) {
        $esDisponible = false;
        $tipoDocumentoId = $this->getEntero('Select_TipoDocumento');
        //validar que tipo documento no exista en espaio

        $documento = new DocumentoEspacio();
        if ($documento->existe($espacioId, $tipoDocumentoId)) {
            $esDisponible = false;
        } else {
            $esDisponible = true;
        }

        if ($tipoDocumentoId == 0)
            $esDisponible = false;

        echo json_encode(array('valid' => $esDisponible));
    }

}
