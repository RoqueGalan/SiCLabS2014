<?php

class CursoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'Curso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Curso-Lista';
        $curso = new Curso();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //listas
        $this->_vista->listaCursos = $paginador->paginar($curso->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'curso/index');

        $this->_vista->render('curso/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Curso-Mostrar';
        $this->_vista->curso = new Curso();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->curso->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->curso->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("curso/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'curso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Curso-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->curso = new Curso();

        /* logica */
        $this->_vista->curso->setId(0);
        // listas
        $this->_vista->listaUdas = $this->_vista->curso->getUda()->lista();
        $this->_vista->listaGrupos = $this->_vista->curso->getGrupo()->lista();
        $this->_vista->listaCiclos = $this->_vista->curso->getCiclo()->lista();

        $this->_vista->render('curso/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'curso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Curso-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->curso = new Curso();

        /* logica */
        $this->_vista->curso->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->curso->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        // listas
        $this->_vista->listaUdas = $this->_vista->curso->getUda()->lista();
        $this->_vista->listaGrupos = $this->_vista->curso->getGrupo()->lista();
        $this->_vista->listaCiclos = $this->_vista->curso->getCiclo()->lista();

        $this->_vista->render('curso/editar');
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
         * Select_Uda:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Uda';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Uda = $val->getValor($campo);

        /*
         * Select_Grupo:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Grupo';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Grupo = $val->getValor($campo);

        /*
         * Select_Ciclo:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Ciclo';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Ciclo = $val->getValor($campo);

        /*
         * Descripcion
         * Letras y Numeros
         */
        $campo = 'Descripcion';
        $val->alfanumerico($campo);
        $descripcion = $val->getValor($campo);



        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'curso');

            $this->_vista->curso = new Curso();

            $this->_vista->curso->setId($id);
            $this->_vista->curso->getUda()->setId($select_Uda);
            $this->_vista->curso->getGrupo()->setId($select_Grupo);
            $this->_vista->curso->getCiclo()->setId($select_Ciclo);
            $this->_vista->curso->setDescripcion($descripcion);

            // listas
            $this->_vista->listaUdas = $this->_vista->curso->getUda()->lista();
            $this->_vista->listaGrupos = $this->_vista->curso->getGrupo()->lista();
            $this->_vista->listaCiclos = $this->_vista->curso->getCiclo()->lista();


            //redirigir a la vista
            $id ?
                            $this->_vista->render('curso/editar') :
                            $this->_vista->render('curso/nuevo');
        } else {
            // no se encontraron errores
            $curso = new Curso();

            $curso->getUda()->setId($select_Uda);
            $curso->getGrupo()->setId($select_Grupo);
            $curso->getCiclo()->setId($select_Ciclo);
            $curso->setDescripcion($descripcion);

            if ($id == 0) {
                //insertar
                // comprobar que campo Uda, grupo, ciclo no repetido en curso
                if ($curso->existe($select_Uda, $select_Grupo, $select_Ciclo)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $curso->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                $existe = $uda->existe($select_Uda, $select_Grupo, $select_Ciclo);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $curso->setId($id);
                $curso->actualizar();
            }

            $this->redireccionar('curso/index/');
        }
    }

    function eliminar($id) {
        $curso = new Curso();
        $curso->buscar($id);

        // comprobar que el registro exista
        if ($curso->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $curso->eliminar($id);
        $this->redireccionar('curso/index/');
    }

    function _comprobar() {
        $esDisponible = false;

        $udaId = $this->getEntero('Select_Uda');
        $grupoId = $this->getEntero('Select_Grupo');
        $cicloId = $this->getEntero('Select_Ciclo');

        //validar que campo Uda, grupo, ciclo no repetido en curso
        $curso = new Curso();
        if ($curso->existe($udaId, $grupoId, $cicloId)) {
            $esDisponible = false;
        } else {
            $esDisponible = true;
        }

        echo json_encode(array('valid' => $esDisponible));
    }

}
