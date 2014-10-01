<?php

class RolControlador extends Controlador {

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
        $this->_vista->titulo = 'Rol-Lista';
        $rol = new Rol();
        $paginador = new Paginador();

        $this->_vista->listaRoles = $paginador->paginar($rol->lista(), $pagina, 10);
        $this->_vista->paginacion = $paginador->getVista('prueba', 'rol/index');

        $this->_vista->render('rol/index');
    }

    function mostrar($Id) {
        //mostrar 
        $this->_vista->titulo = 'Rol-Mostrar';
        $this->_vista->rol = new Rol();
        $this->_vista->rol->buscar($Id);

        //verificar que exista
        if ($this->_vista->rol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("rol/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'Rol-Nuevo';

        $this->_vista->rol = new Rol();
        $this->_vista->rol->setId(0);

        $this->_vista->render('rol/nuevo');
    }

    function editar($id) {
        $this->_vista->titulo = 'Rol-Editar';

        $this->_vista->rol = new Rol();
        $this->_vista->rol->buscar($id);

        //verificar que exista
        if ($this->_vista->rol->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }


        $this->_vista->render('rol/editar');
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

            $this->_vista->rol = new Rol();
            $this->_vista->rol->setId($id);
            $this->_vista->rol->setNombre($nombre);


            if ($id == 0) {
                $this->_vista->render('rol/nuevo');
            } else {
                $this->_vista->render('rol/editar');
            }
        } else {

            //aplicar patron Factory
            //if id == 0 entonces insertar
            //si no entonces actualziar

            $rol = new Rol();
            $rol->setNombre($nombre);

            if ($id == 0) {
                //insertar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                
                if ($rol->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $rol->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($rol->existe($nombre) != $id) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $rol->setId($id);
                $rol->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $rol = new Rol();
        $rol->eliminar($id);
        $this->index();
    }

}
