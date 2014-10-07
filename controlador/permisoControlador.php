<?php

class PermisoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        //preparar el paginador
        if(!$this->filtrarEntero($pagina)){
           $pagina = false;
        }
        else{
           $pagina = (int) $pagina;
        }
        
       
        //lista de permisos
        $this->_vista->titulo = 'Permiso-Lista';
        $permiso = new Permiso();

        $paginador = new Paginador();	
         
        $this->_vista->listaPermisos = $paginador->paginar($permiso->lista(), $pagina, 10);
        
        //$this->_vista->listaPermisos = $permiso->lista();
        $this->_vista->paginacion = $paginador->getVista('prueba' , 'permiso/index');
     
        $this->_vista->render('permiso/index');
    }

    function mostrar($Id) {
        //mostrar 
        $this->_vista->titulo = 'Permiso-Mostrar';
        $this->_vista->permiso = new Permiso();
        $this->_vista->permiso->buscar($Id);

        //verificar que exista
        if ($this->_vista->permiso->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("permiso/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'Permiso-Nuevo';

        $this->_vista->permiso = new Permiso();
        $this->_vista->permiso->setId(0);

        $this->_vista->render('permiso/nuevo');
    }

    function editar($id) {
        $this->_vista->titulo = 'Permiso-Editar';

        $this->_vista->permiso = new Permiso();
        $this->_vista->permiso->buscar($id);

        //verificar que exista
        if ($this->_vista->permiso->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('permiso/editar');
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
         * Validar Descripcion:
         * No Nulo
         * Alfanumerico
         */
        $descripcion = $this->getTexto('Descripcion');
        if (empty($descripcion)) {
            $this->_vista->listaError[] = 'Descripcion Esta Vacio';
        }

        /*
         * Existen Errores
         */
        if (count($this->_vista->listaError)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado a la vista editar
             */

            $this->_vista->permiso = new Permiso();
            $this->_vista->permiso->setId($id);
            $this->_vista->permiso->setNombre($nombre);
            $this->_vista->permiso->setDescripcion($descripcion);

            if ($id == 0) {
                $this->_vista->render('permiso/nuevo');
            } else {
                $this->_vista->render('permiso/editar');
            }
        } else {

            //aplicar patron Factory
            //if id == 0 entonces insertar
            //si no entonces actualziar

            $permiso = new Permiso();
            $permiso->setNombre($nombre);
            $permiso->setDescripcion($descripcion);

            if ($id == 0) {
                //insertar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($permiso->existe($nombre)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $permiso->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                
                $existe = $permiso->existe($nombre);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                
                $permiso->setId($id);
                $permiso->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $permiso = new Permiso();
        $permiso->eliminar($id);
        $this->index();
    }

}
