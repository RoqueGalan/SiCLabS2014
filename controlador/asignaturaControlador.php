<?php

class AsignaturaControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'asignatura');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Asignatura-Lista';
        $asignatura = new Asignatura();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista asignatura
        $this->_vista->listaAsignaturas = $paginador->paginar($asignatura->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'asignatura/index');

        $this->_vista->render('asignatura/index');
    }

    function mostrar($Id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Asignatura-Mostrar';
        $this->_vista->asignatura = new Carrera();

        /* logica */
        $this->_vista->asignatura->buscar($Id);

        // comprobar que el registro exista
        if ($this->_vista->asignatura->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("asignatura/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'asignatura');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Asignatura-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->asignatura = new Asignatura();

        /* logica */
        $this->_vista->asignatura->setId(0);
        $this->_vista->render('asignatura/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'asignatura');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Asignatura-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->asignatura = new Asignatura();

        /* logica */
        $this->_vista->asignatura->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->asignatura->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('asignatura/editar');
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
            $this->_vista->setJs('validarForm', 'asignatura');

            $this->_vista->asignatura = new Asignatura();

            $this->_vista->asignatura->setId($id);
            $this->_vista->asignatura->setNombre($nombre);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('asignatura/editar') :
                            $this->_vista->render('asignatura/nuevo');
        } else {
            // no se encontraron errores
            $asignatura = new Asignatura();

            $asignatura->setNombre($nombre);

            if ($id == 0) {
                //insertar
                // comprobar campo Nombre no repetido
                if ($asignatura->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $asignatura->insertar();
            } else {
                //actualizar
                // comprobar campo Nombre no repetido
                $existe = $asignatura->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $asignatura->setId($id);
                $asignatura->actualizar();
            }

            $this->redireccionar("asignatura/index/");
        }
    }

    function eliminar($id) {
        $asignatura = new Asignatura();
        $asignatura->buscar($id);

        // comprobar que el registro exista
        if ($asignatura->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $asignatura->eliminar($id);
        $this->redireccionar('asignatura/index/');
    }

    function _comprobarNombre() {
        $nombre = $this->getTexto('Nombre');
        if ($nombre != '') {
            $asignatura = new Asignatura();

            $asignatura->existe($nombre) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

}
