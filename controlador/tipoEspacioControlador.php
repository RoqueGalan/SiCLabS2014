<?php

class TipoEspacioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'tipoEspacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoEspacio-Lista';
        $tipoEspacio = new TipoEspacio();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista Tipo Espacio
        $this->_vista->listaTiposEspacio = $paginador->paginar($tipoEspacio->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'rol/index');

        $this->_vista->render('tipoEspacio/index');
    }

    function mostrar($Id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoEspacio-Mostrar';
        $this->_vista->tipoEspacio = new TipoEspacio();

        /* logica */
        $this->_vista->tipoEspacio->buscar($Id);

        // comprobar que el registro exista
        if ($this->_vista->tipoEspacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("tipoEspacio/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'tipoEspacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoEspacio-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->tipoEspacio = new TipoEspacio();

        /* logica */
        $this->_vista->tipoEspacio->setId(0);

        $this->_vista->render('tipoEspacio/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'tipoEspacio');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'TipoEspacio-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->tipoEspacio = new TipoEspacio();

        /* logica */
        $this->_vista->tipoEspacio->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->tipoEspacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('tipoEspacio/editar');
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
            $this->_vista->setJs('validarForm', 'tipoEspacio');

            $this->_vista->tipoEspacio = new TipoEspacio();

            $this->_vista->tipoEspacio->setId($id);
            $this->_vista->tipoEspacio->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('usuario/editar') :
                            $this->_vista->render('usuario/nuevo');
        } else {
            // no se encontraron errores
            $tipoEspacio = new TipoEspacio();
            
            $tipoEspacio->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                if ($tipoEspacio->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $tipoEspacio->insertar();
            } else {
                //actualizar
                // comprobar campo Nombre no repetido
                $existe = $tipoEspacio->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $tipoEspacio->setId($id);
                $tipoEspacio->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $tipoEspacio = new TipoEspacio();
        $tipoEspacio->buscar($id);

        // comprobar que el registro exista
        if ($tipoEspacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $tipoEspacio->eliminar($id);
        $this->redireccionar('tipoEspacio/index/');
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $tipoEspacio = new TipoEspacio();

            $tipoEspacio->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
