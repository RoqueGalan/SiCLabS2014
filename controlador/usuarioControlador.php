<?php

class UsuarioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'Usuario');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Usuario-Lista';
        $usuario = new Usuario();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista Usuarios
        $this->_vista->listaUsuarios = $paginador->paginar($usuario->lista(), $pagina, 30);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'usuario/index');

        $this->_vista->render('usuario/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Usuario-Mostrar';
        $this->_vista->usuario = new Usuario();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->usuario->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->usuario->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("usuario/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'usuario');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Usuario-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->usuario = new Usuario();

        /* logica */
        $this->_vista->usuario->setId(0);
        // lista de roless
        $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();

        $this->_vista->render('usuario/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'usuario');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Usuario-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->usuario = new Usuario();

        /* logica */
        $this->_vista->usuario->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->usuario->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de roles
        $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();

        $this->_vista->render('usuario/editar');
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
         * Matricula
         * Requerido
         * Solo 7 caracteres
         */
        $campo = 'Matricula';
        $val->requerido($campo);
        $val->cadenaLongitud($campo, '=', 7);
        $matricula = $val->getValor($campo);

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

        /*
         * Apellido (s)
         * Requerido
         * Letras
         * Rango (2,64)
         */
        $campo = 'Apellido';
        $val->requerido($campo);
        $val->letras($campo);
        $val->cadenaRango($campo, 2, 64, 1);
        $apellido = $val->getValor($campo);

        /*
         * Correo
         * Requerido
         * Correo
         * Longitud Max 64
         */
        $campo = 'Correo';
        $val->requerido($campo);
        $val->email($campo);
        $val->cadenaLongitud($campo, '<=', 64);
        $correo = $val->getValor($campo);


        /*
         * Contraseña
         * Requerido
         */
        $campo = 'Contrasena';
        $val->requerido($campo);
        $contrasena = $val->getValor($campo);


        /*
         * Select-Rol:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Rol';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Rol = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'usuario');

            $this->_vista->usuario = new Usuario();

            $this->_vista->usuario->setId($id);
            $this->_vista->usuario->setMatricula($matricula);
            $this->_vista->usuario->setNombre($nombre);
            $this->_vista->usuario->setApellido($apellido);
            $this->_vista->usuario->setCorreo($correo);
            $this->_vista->usuario->setContrasena($contrasena);
            $this->_vista->usuario->getRol()->setId($select_Rol);
            //lista de rol
            $this->_vista->listaRoles = $this->_vista->usuario->getRol()->lista();

            //redirigir a la vista
            $id ?
                            $this->_vista->render('usuario/editar') :
                            $this->_vista->render('usuario/nuevo');
        } else {
            // no se encontraron errores
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
                // comprobar campo Nombre no repetido
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
                $existe = $usuario->existe($matricula);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $usuario->setId($id);
                $usuario->actualizar();
            }

            $this->index();
        }
    }

    function eliminar($id) {
        $usuario = new Usuario();
        $usuario->buscar($id);

        // comprobar que el registro exista
        if ($usuario->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $usuario->eliminar($id);
        $this->redireccionar('usuario/index/');
    }

    function _comprobarMatricula() {
        $matricula = $this->getTexto('Matricula');
        if ($matricula != '') {
            $usuario = new Usuario();

            $usuario->existe($matricula) ?
                            $esDisponible = false :
                            $esDisponible = true;
        } else {
            $esDisponible = false;
        }
        echo json_encode(array('valid' => $esDisponible));
    }

    function _buscarFiltro($id) {
        $usuario = new Usuario();

        switch ($id) {
            case 'NombreCompleto':
                $parametros = array(
                    'nombre' => $this->getTexto('B_Nombre'),
                    'apellido' => $this->getTexto('B_Apellido')
                );
                echo json_encode($usuario->filtro($parametros, 'NombreCompleto'));
                break;
            case 'Matricula':
                $parametros = array(
                    'matricula' => $this->getTexto('B_Matricula')
                );
                echo json_encode($usuario->filtro($parametros, 'Matricula'));
                break;
            case 'Rol':
                $parametros = array(
                    'rol' => $this->getTexto('B_Rol')
                );
                echo json_encode($usuario->filtro($parametros, 'Rol'));
                break;

            default:
                break;
        }
    }

}
