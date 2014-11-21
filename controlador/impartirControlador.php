<?php

class ImpartirControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($CursoId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'impartir');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Impartir-Lista';
        $CursoId = $this->filtrarEntero($CursoId);
        $impartir = new Impartir();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Curso
        $impartir->getCurso()->buscar($CursoId);
        // comprobar que el registro exista
        if ($impartir->getCurso()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->curso = $impartir->getCurso();
        //lista Equipo
        $this->_vista->listaImpartir = $paginador->paginar($impartir->lista($CursoId), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'impartir/index/' . $impartir->getCurso()->getId());

        $this->_vista->render('impartir/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Impartir-Mostrar';
        $this->_vista->impartir = new Impartir();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->impartir->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->impartir->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("impartir/mostrar");
    }

    function nuevo($CursoId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'impartir');
        $this->_vista->setJs('ajaxFiltrar', 'impartir');


        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Impartir-Nuevo';
        $CursoId = $this->filtrarEntero($CursoId);
        $this->_vista->errorForm = array();
        $this->_vista->impartir = new Impartir();
        $this->_vista->usuario = new Usuario();

        /* logica */
        $this->_vista->impartir->getCurso()->buscar($CursoId);
        // comprobar que el registro exista
        if ($this->_vista->impartir->getCurso()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->impartir->setId(0);

        // lista de cursos
        $this->_vista->listaCursos = $this->_vista->impartir->getCurso()->lista($this->_vista->impartir->getCurso()->getEspacio()->getId());

        // lista de usuarios
        $this->_vista->listaRoles = $this->_vista->impartir->getUsuario()->getRol()->lista();

        $this->_vista->render('impartir/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'impartir');
        $this->_vista->setJs('ajaxFiltrar', 'impartir');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Impartir-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->impartir = new Impartir();

        /* logica */
        $this->_vista->impartir->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->impartir->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        // lista de cursos
        $this->_vista->listaCursos = $this->_vista->impartir->getCurso()->lista($this->_vista->impartir->getCurso()->getEspacio()->getId());

        // lista de roles
        $this->_vista->listaRoles = $this->_vista->impartir->getUsuario()->getRol()->lista();

        // usuario
        $this->_vista->usuario = $this->_vista->impartir->getUsuario();

        $this->_vista->render('impartir/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $impartir = new Impartir();

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
         * Select-Curso:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Curso';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Curso = $val->getValor($campo);

        /*
         * Select-Usuario:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Usuario';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Usuario = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'impartir');
            $this->_vista->setJs('ajaxFiltrar', 'impartir');

            $impartir->setId($id);
            $impartir->getCurso()->buscar($select_Curso);
            $impartir->getUsuario()->buscar($select_Usuario);

            $this->_vista->impartir = $impartir;

            // lista de cursos
            $this->_vista->listaCursos = $this->_vista->impartir->getCurso()->lista($this->_vista->impartir->getCurso()->getEspacio()->getId());

            // lista de roles
            $this->_vista->listaRoles = $this->_vista->impartir->getUsuario()->getRol()->lista();

            // usuario
            $this->_vista->usuario = $this->_vista->impartir->getUsuario();
            //redirigir a la vista
            $id ?
                            $this->_vista->render('impartir/editar') :
                            $this->_vista->render('impartir/nuevo');
        } else {
            // no se encontraron errores
            $impartir->getCurso()->buscar($select_Curso);
            $impartir->getUsuario()->buscar($select_Usuario);
            

            if ($id == 0) {
                //insertar
                // comprobar campo Uda no repetido en Carrera
                if ($impartir->existe($select_Curso)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $impartir->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                $existe = $impartir->existe($select_Curso);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $impartir->setId($id);
                $impartir->actualizar();
            }

            $this->redireccionar("impartir/index/{$impartir->getCurso()->getId()}");
        }
    }
    
    function eliminar($id) {
        $impartir = new Impartir();
        $impartir->buscar($id);
        // comprobar que el registro exista
        if ($impartir->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $impartir->eliminar($id);

        $this->redireccionar('impartir/index/' . $impartir->getCurso()->getId());
    }
    
    

}
