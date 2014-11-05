<?php

class SoftwareControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($EspacioId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'software');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Software-Lista';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $software = new Software();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Rol
        $software->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($software->getEspacio()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->espacio = $software->getEspacio();
        //lista Equipo
        $this->_vista->listaSoftware = $paginador->paginar($software->lista($EspacioId), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'software/index/' . $software->getEspacio()->getId());

        $this->_vista->render('software/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'software-Mostrar';
        $this->_vista->software = new Software();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->software->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->software->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("software/mostrar");
    }

    function nuevo($EspacioId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'software');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Software-Nuevo';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $this->_vista->errorForm = array();
        $this->_vista->software = new Software();

        /* logica */
        $this->_vista->software->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($this->_vista->software->getEspacio()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->software->setId(0);

        // lista de espacios
        $this->_vista->listaEspacios = $this->_vista->software->getEspacio()->lista();

        $this->_vista->render('software/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'software');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Software-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->software = new Software();

        /* logica */
        $this->_vista->software->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->software->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de espacios
        $this->_vista->listaEspacios = $this->_vista->software->getEspacio()->lista();

        $this->_vista->render('software/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $software = new Software();

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
         * Rango (1,64)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->cadenaRango($campo, 1, 64, 1);
        $nombre = $val->getValor($campo);

        /*
         * Caracteristicas
         */
        $campo = 'Descripcion';
        $descripcion = $val->getValor($campo);

        /*
         * Select-Oculto:
         * Requerido
         * Solo acepta: 'Visible', 'Oculto'
         */
        $campo = 'Select_Oculto';
        $val->requerido($campo);
        $val->compararPalabras($campo, $arreglo = array('Visible', 'Oculto'));
        $select_Oculto = $val->getValor($campo);

        /*
         * Select_Espacio:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Espacio';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Espacio = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'software');

            $software->setId($id);
            $software->setNombre($nombre);
            $software->setDescripcion($descripcion);
            $software->setOculto($select_Oculto);
            $software->getEspacio()->setId($select_Espacio);

            $this->_vista->software = $software;

            //lista de espacios
            $this->_vista->listaEspacios = $software->getEspacio()->lista();

            //redirigir a la vista
            $id ?
                            $this->_vista->render('software/editar') :
                            $this->_vista->render('software/nuevo');
        } else {
            // no se encontraron errores
            $software->setNombre($nombre);
            $software->setDescripcion($descripcion);
            $software->setOculto($select_Oculto);
            $software->getEspacio()->setId($select_Espacio);

            if ($id == 0) {
                //insertar
                $software->insertar();
            } else {
                //actualizar
                $software->setId($id);
                $software->actualizar();
            }

            $this->redireccionar("software/index/{$software->getEspacio()->getId()}");
        }
    }

    function eliminar($id) {
        $software = new Software();
        $software->buscar($id);
        // comprobar que el registro exista
        if ($software->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $software->eliminar($id);

        $this->redireccionar('software/index/' . $software->getEspacio()->getId());
    }

}
