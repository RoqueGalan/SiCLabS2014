<?php

class grupoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'grupo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Grupo-Lista';
        $grupo = new Grupo();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista carrera
        $this->_vista->listaGrupos = $paginador->paginar($grupo->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'grupo/index');

        $this->_vista->render('grupo/index');
    }

    function mostrar($Id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Grupo-Mostrar';
        $this->_vista->grupo = new Grupo();

        /* logica */
        $this->_vista->grupo->buscar($Id);

        // comprobar que el registro exista
        if ($this->_vista->grupo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("grupo/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'grupo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Grupo-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->grupo = new Carrera();

        /* logica */
        $this->_vista->grupo->setId(0);
        $this->_vista->render('grupo/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'grupo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Grupo-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->grupo = new Grupo();

        /* logica */
        $this->_vista->grupo->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->grupo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('grupo/editar');
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
         * Rango (2,8)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->cadenaRango($campo, 2, 8, 1);
        $nombre = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'grupo');

            $this->_vista->grupo = new Grupo();

            $this->_vista->grupo->setId($id);
            $this->_vista->grupo->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('grupo/editar') :
                            $this->_vista->render('grupo/nuevo');
        } else {
            // no se encontraron errores
            $grupo = new Grupo();

            $grupo->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                if ($grupo->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $grupo->insertar();
            } else {
                //actualizar
                // comprobar campo Nombre no repetido
                $existe = $grupo->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $grupo->setId($id);
                $grupo->actualizar();
            }

            $this->redireccionar("grupo/index/");
        }
    }

    function eliminar($id) {
        $grupo = new Grupo();
        $grupo->buscar($id);

        // comprobar que el registro exista
        if ($grupo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $grupo->eliminar($id);
        $this->redireccionar('grupo/index/');
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $grupo = new Grupo();

            $grupo->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
