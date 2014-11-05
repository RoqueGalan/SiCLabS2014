<?php

class CarreraControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'carrera');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Carrera-Lista';
        $carrera = new Carrera();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista carrera
        $this->_vista->listaCarreras = $paginador->paginar($carrera->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'carrera/index');

        $this->_vista->render('carrera/index');
    }

    function mostrar($Id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Carrera-Mostrar';
        $this->_vista->carrera = new Carrera();

        /* logica */
        $this->_vista->carrera->buscar($Id);

        // comprobar que el registro exista
        if ($this->_vista->carrera->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("carrera/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'carrera');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Carrera-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->carrera = new Carrera();

        /* logica */
        $this->_vista->carrera->setId(0);
        $this->_vista->render('carrera/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'carrera');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Carrera-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->carrera = new Carrera();

        /* logica */
        $this->_vista->carrera->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->carrera->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('carrera/editar');
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
         * Rango (2,64)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->letras($campo);
        $val->cadenaRango($campo, 2, 64, 1);
        $nombre = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'carrera');

            $this->_vista->carrera = new Carrera();

            $this->_vista->carrera->setId($id);
            $this->_vista->carrera->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('carrera/editar') :
                            $this->_vista->render('carrera/nuevo');
        } else {
            // no se encontraron errores
            $carrera = new Carrera();

            $carrera->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                if ($carrera->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $carrera->insertar();
            } else {
                //actualizar
                // comprobar campo Nombre no repetido
                $existe = $carrera->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $carrera->setId($id);
                $carrera->actualizar();
            }

            $this->redireccionar("carrera/index/");
        }
    }

    function eliminar($id) {
        $carrera = new Carrera();
        $carrera->buscar($id);

        // comprobar que el registro exista
        if ($carrera->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $carrera->eliminar($id);
        $this->redireccionar('carrera/index/');
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $carrera = new Carrera();

            $carrera->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
