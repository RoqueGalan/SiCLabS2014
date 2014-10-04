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
        $this->_vista->errorForm = array();
        $this->_vista->titulo = 'Rol-Nuevo';

        $this->_vista->rol = new Rol();
        $this->_vista->rol->setId(0);

        $this->_vista->render('rol/nuevo');
    }

    function editar($id) {
        $this->_vista->errorForm = array();
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
        $this->_vista->errorForm = array();
        
        /*
         * validar Id por Get y Post
         */
        if ($id != $this->getEntero('Id')) {
            $this->redireccionar('error/tipo/Registro_NoID');
        }
        $id = $this->getEntero('Id');
        
        
        /*
         * Validar campos del FORMULARIO
         * correcto ACTUALIZAR o NSERTAR en la BD
         * incorrecto devolver valores a las vistas EDITAR o NUEVO
         */
        
        $val = new Validador($_POST);
        
        /*
         * Nombre
         * Requerido
         * Letras
         * Rango (4,32)
         */
        $val->requerido('Nombre');
        $val->letras('Nombre');
        $val->cadenaRango('Nombre', 4, 32,1);
        $nombre = $val->getValor('Nombre');
        
        

        /*
         * Existen Errores
         */
        $this->_vista->errorForm = $val->getErrorLista();
        
        if (count($this->_vista->errorForm)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado al formulario
             * esto se hace por si en el navegador se tiene desactivado javascript
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
            die;
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
