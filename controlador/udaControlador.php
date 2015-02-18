<?php

class udaControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'uda');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Uda-Lista';
        $uda = new Uda();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista carreras
        $this->_vista->listaUdas = $paginador->paginar($uda->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'uda/index');

        $this->_vista->render('uda/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Uda-Mostrar';
        $this->_vista->uda = new Uda();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->uda->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->uda->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("uda/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'uda');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Uda-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->uda = new Uda();

        /* logica */
        $this->_vista->uda->setId(0);
        // lista de carreras
        $this->_vista->listaCarreras = $this->_vista->uda->getCarrera()->lista();
        // lista de asignaturas
        $this->_vista->listaAsignaturas = $this->_vista->uda->getAsignatura()->lista();

        
        $this->_vista->render('uda/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'uda');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Uda-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->uda = new Uda();

        /* logica */
        $this->_vista->uda->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->uda->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de carreras
        $this->_vista->listaCarreras = $this->_vista->uda->getCarrera()->lista();
        // lista de asignaturas
        $this->_vista->listaAsignaturas = $this->_vista->uda->getAsignatura()->lista();

        $this->_vista->render('uda/editar');
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
         * Select-Asignatura:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Asignatura';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Asignatura = $val->getValor($campo);

        /*
         * Select_Carrera:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Carrera';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Carrera = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'uda');

            $this->_vista->uda = new Uda();

            $this->_vista->uda->setId($id);
            $this->_vista->uda->getAsignatura()->setId($select_Asignatura);
            $this->_vista->uda->getCarrera()->setId($select_Carrera);

            //lista de carreras
            $this->_vista->listaCarreras = $this->_vista->uda->getCarrera()->lista();
            // lista de asignaturas
            $this->_vista->listaAsignaturas = $this->_vista->uda->getAsignatura()->lista();


            //redirigir a la vista
            $id ?
                            $this->_vista->render('uda/editar') :
                            $this->_vista->render('uda/nuevo');
        } else {
            // no se encontraron errores
            $uda = new Uda();

            $uda->getAsignatura()->setId($select_Asignatura);
            $uda->getCarrera()->setId($select_Carrera);

            if ($id == 0) {
                //insertar
                // comprobar campo Uda no repetido en Carrera
                if ($uda->existe($select_Asignatura, $select_Carrera)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $uda->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                $existe = $uda->existe($select_Asignatura, $select_Carrera);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $uda->setId($id);
                $uda->actualizar();
            }

            $this->redireccionar('uda/index/');
        }
    }

    function eliminar($id) {
        $uda = new Uda();
        $uda->buscar($id);

        // comprobar que el registro exista
        if ($uda->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $uda->eliminar($id);
        $this->redireccionar('uda/index/');
    }

    function _comprobarAsignaturaCarrera() {
        $asignaturaId = $this->getTexto('Select_Asignatura');
        $carreraId = $this->getEntero('Select_Carrera');
        $id = $this->getEntero('Id');
        $uda = new Uda();

        if ($uda->existe($asignaturaId, $carreraId)) {
            //permiso existe
            if ($id != 0) {
                $uda->buscar($id);
                ($uda->getAsignatura()->getId() == $asignaturaId && $uda->getCarrera()->getId() == $carreraId) ?
                                $esDisponible = true :
                                $esDisponible = false;
            } else {
                $esDisponible = false;
            }
        } else {
            $esDisponible = true;
        }
        
        if($asignaturaId == 0 )
            $esDisponible = false;
            

        echo json_encode(array('valid' => $esDisponible));
    }

}
