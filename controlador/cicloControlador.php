<?php

class cicloControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'ciclo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Ciclo-Lista';
        $ciclo = new Ciclo();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista carrera
        $this->_vista->listaCiclos = $paginador->paginar($ciclo->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'ciclo/index');

        $this->_vista->render('ciclo/index');
    }

    function mostrar($Id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Ciclo-Mostrar';
        $this->_vista->ciclo = new Ciclo();

        /* logica */
        $this->_vista->ciclo->buscar($Id);

        // comprobar que el registro exista
        if ($this->_vista->ciclo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("ciclo/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('jquery.mask.min');
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'ciclo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Ciclo-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->ciclo = new Ciclo();

        /* logica */
        $this->_vista->ciclo->setId(0);
        $this->_vista->render('ciclo/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('jquery.mask.min');
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'ciclo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Ciclo-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->ciclo = new Ciclo();

        /* logica */
        $this->_vista->ciclo->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->ciclo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('ciclo/editar');
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
         * Soslo 6 caracteres
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->cadenaLongitud($campo, '=', 6);
        $nombre = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('jquery.mask.min');
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'ciclo');

            $this->_vista->ciclo = new Ciclo();

            $this->_vista->ciclo->setId($id);
            $this->_vista->ciclo->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('ciclo/editar') :
                            $this->_vista->render('ciclo/nuevo');
        } else {
            // no se encontraron errores
            $ciclo = new Ciclo();

            $ciclo->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                if ($ciclo->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $ciclo->insertar();
            } else {
                //actualizar
                // comprobar campo Nombre no repetido
                $existe = $ciclo->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $ciclo->setId($id);
                $ciclo->actualizar();
            }

            $this->redireccionar("ciclo/index/");
        }
    }
    
    function eliminar($id) {
        $ciclo = new Ciclo();
        $ciclo->buscar($id);

        // comprobar que el registro exista
        if ($ciclo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $ciclo->eliminar($id);
        $this->redireccionar('ciclo/index/');
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $ciclo = new Ciclo();

            $ciclo->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
