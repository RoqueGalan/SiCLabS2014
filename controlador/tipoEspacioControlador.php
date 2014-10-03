<?php

class TipoEspacioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        //preparar el paginador
        if (!$this->filtrarEntero($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }

        //lista de los roles
        $this->_vista->titulo = 'TipoEspacio-Lista';
        $tipoEspacio = new TipoEspacio();
        $paginador = new Paginador();

        $this->_vista->listaTiposEspacio = $paginador->paginar($tipoEspacio->lista(), $pagina, 10);
        $this->_vista->paginacion = $paginador->getVista('prueba', 'rol/index');

        $this->_vista->render('tipoEspacio/index');
    }

    function mostrar($Id) {
        //mostrar 
        $this->_vista->titulo = 'TipoEspacio-Mostrar';
        $this->_vista->tipoEspacio = new TipoEspacio();
        $this->_vista->tipoEspacio->buscar($Id);

        //verificar que exista
        if ($this->_vista->tipoEspacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("tipoEspacio/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'TipoEspacio-Nuevo';

        $this->_vista->tipoEspacio = new TipoEspacio();
        $this->_vista->tipoEspacio->setId(0);

        $this->_vista->render('tipoEspacio/nuevo');
    }

    function editar($id) {
        $this->_vista->titulo = 'TipoEspacio-Editar';

        $this->_vista->tipoEspacio = new TipoEspacio();
        $this->_vista->tipoEspacio->buscar($id);

        //verificar que exista
        if ($this->_vista->tipoEspacio->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('tipoEspacio/editar');
    }

    function _guardar($id) {
        $this->_vista->listaError = array();

        /*
         * realizar las validaciones
         * si todo esta correcto ACTUALIZAR
         * si no entonces devolver los valores a la vista EDITAR o NUEVO
         */

        /*
         * validar Id por Get y Post
         * Evita posibles ataques a la seguridad
         */
        if ($id != $this->getEntero('Id')) {
            $this->redireccionar('error/tipo/Registro_NoID');
        }
        $id = $this->getEntero('Id');

        /*
         * Validar Nombre:
         * No Nulo
         * Alfanumerico
         */
        $nombre = $this->getTexto('Nombre');
        if (empty($nombre)) {
            $this->_vista->listaError[] = 'Nombre Esta Vacio';
        }

        /*
         * Existen Errores
         */
        if (count($this->_vista->listaError)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado al formulario
             */

            $this->_vista->tipoEspacio = new TipoEspacio();
            $this->_vista->tipoEspacio->setId($id);
            $this->_vista->tipoEspacio->setNombre($nombre);


            if ($id == 0) {
                $this->_vista->render('tipoEspacio/nuevo');
            } else {
                $this->_vista->render('tipoEspacio/editar');
            }
        } else {

            //aplicar patron Factory
            //if id == 0 entonces insertar
            //si no entonces actualziar

            $tipoEspacio = new TipoEspacio();
            $tipoEspacio->setNombre($nombre);

            if ($id == 0) {
                //insertar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */

                if ($tipoEspacio->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $tipoEspacio->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($tipoEspacio->existe($nombre) != $id) {
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
        $tipoEspacio->eliminar($id);
        $this->index();
    }

}
