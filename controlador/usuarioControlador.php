<?php

class UsuarioControlador extends Controlador {

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

        //lista de usuarios
        $this->_vista->titulo = 'Usuario-Lista';
        $usuario = new Usuario();
        $paginador = new Paginador();

        $this->_vista->listaUsuarios = $paginador->paginar($usuario->lista(), $pagina, 10);
        $this->_vista->paginacion = $paginador->getVista('prueba', 'usuario/index');

        $this->_vista->render('usuario/index');
    }

    function mostrar($id) {
        //mostrar 
        $this->_vista->titulo = 'Usuario-Mostrar';
        $this->_vista->usuario = new Usuario();
        $this->_vista->usuario->buscar($id);

        //verificar que existia
        if ($this->_vista->usuario->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("usuario/mostrar");
    }

    function nuevo() {
        $this->_vista->titulo = 'Usuario-Nuevo';

        $this->_vista->usuario = new Usuario();
        $this->_vista->usuario->setId('0');

        $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();

        $this->_vista->render('usuario/nuevo');
    }

    function editar($id) {
        $this->_vista->titulo = 'Usuario-Editar';

        $this->_vista->usuario = new Usuario();
        $this->_vista->usuario->buscar($id);

        //verificar que exista
        if ($this->_vista->usuario->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();

        $this->_vista->render('usuario/editar');
    }

    function _guardar($id) {
        $this->_vista->listaError = array();
        /*
         * realizar las validaciones
         * si todo esta correcto ACTUALIZAR
         * si no entonces devolver los valores a la vista EDITAR o NUEVO
         */

        /*
         * validar Matricula por Get y Post
         * Evita posibles ataques a la seguridad
         * PENDIENTE
         * verificar si matricula 0 es nuevo registro e ignorar
         * si no entonces verificar que la matricula coincidan
         */
        if ($id != $this->getEntero('Id')) {
            $this->redireccionar('error/tipo/Registro_NoID');
        }
        $id = $this->getEntero('Id');


        /*
         * validar Matricula:
         * No Nulo
         * PENDIENTE
         * verificar si id 0 es nuevo registro y verificar que matricula no este registrada
         * si id no es 0 verificar que la matricula corresponda al id
         */
        $matricula = $this->getTexto('Matricula');
        if (empty($matricula)) {
            $this->_vista->listaError[] = 'Matricula Esta Vacio';
        }



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
         * Validar Apellido:
         * No Nulo
         * Alfanumerico
         */
        $apellido = $this->getTexto('Apellido');
        if (empty($apellido)) {
            $this->_vista->listaError[] = 'Apellido Esta Vacio';
        }

        /*
         * Validar Correo:
         * No Nulo
         * Tipo Email
         */
        $correo = $this->getTexto('Correo');
        if (empty($correo)) {
            $this->_vista->listaError[] = 'Correo Esta Vacio';
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->_vista->listaError[] = 'Correo es Incorrecto';
        }

        /*
         * Validar Contraseña:
         * No Nulo
         */
        $contrasena = $this->getTexto('Contrasena');
        if (empty($contrasena)) {
            $this->_vista->listaError[] = 'Contrasena Esta Vacio';
        }

       

        /*
         * Validar Select-Rol:
         * No Select
         */
        $select_Rol = $this->getEntero('Select-Rol');
        if ($select_Rol == 0) {
            $this->_vista->listaError[] = 'Seleccione un rol';
        }

//        foreach ($_POST as $key => $value) {
//            echo $key . ': ' . $value . '<br>';
//        }



        /*
         * Existen Errores
         */
        if (count($this->_vista->listaError)) {
            /*
             * al encontrar errores hay que redirigir lo ingresado al formulario
             */

            $this->_vista->usuario = new Usuario();
            $this->_vista->usuario->setId($id);
            $this->_vista->usuario->setMatricula($matricula);
            $this->_vista->usuario->setNombre($nombre);
            $this->_vista->usuario->setApellido($apellido);
            $this->_vista->usuario->setCorreo($correo);
            $this->_vista->usuario->setContrasena('');
            $this->_vista->usuario->getRol()->setId($select_Rol);

            $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();

            if ($id == 0) {
                $this->_vista->render('usuario/nuevo');
            } else {
                $this->_vista->render('usuario/editar');
            }
        } else {

            //aplicar patron Factory
            //if matricula == 0 entonces insertar
            //si no entonces actualziar

            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setMatricula($matricula);
            $usuario->setNombre($nombre);
            $usuario->setApellido($apellido);
            $usuario->setCorreo($correo);
            $usuario->setContrasena($contrasena);
            $usuario->getRol()->setId($select_Rol);



            if ($id == 0) {
                //insertar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */

                if ($usuario->existe($matricula)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $usuario->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                if ($usuario->existe($matricula) != $id) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $usuario->setId($id);
                $usuario->actualizar();
            }

            $this->index();
        }
    }

}
