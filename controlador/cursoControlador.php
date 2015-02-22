<?php

class CursoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($EspacioId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'curso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Curso-Lista';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $curso = new Curso();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el espacio
        $curso->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($curso->getEspacio()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->espacio = $curso->getEspacio();
        //listas
        $this->_vista->listaCursos = $paginador->paginar($curso->lista($EspacioId), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'curso/index' . $curso->getEspacio()->getId());

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

    function nuevo($EspacioId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'curso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Curso-Nuevo';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $this->_vista->errorForm = array();
        $this->_vista->curso = new Curso();

        /* logica */
        $this->_vista->curso->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($this->_vista->curso->getEspacio()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->curso->setId(0);
        // listas
        $this->_vista->listaAsignaturas = $this->_vista->curso->getAsignatura()->lista();
        $this->_vista->listaCarreras = $this->_vista->curso->getCarrera()->lista();
        $this->_vista->listaGrupos = $this->_vista->curso->getGrupo()->lista();
        $this->_vista->listaCiclos = $this->_vista->curso->getCiclo()->lista();
        $this->_vista->listaEspacios = $this->_vista->curso->getEspacio()->lista();


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
        $this->_vista->listaAsignaturas = $this->_vista->curso->getAsignatura()->lista();
        $this->_vista->listaCarreras = $this->_vista->curso->getCarrera()->lista();
        $this->_vista->listaGrupos = $this->_vista->curso->getGrupo()->lista();
        $this->_vista->listaCiclos = $this->_vista->curso->getCiclo()->lista();
        $this->_vista->listaEspacios = $this->_vista->curso->getEspacio()->lista();


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
         * Select_Asignatura:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Asignatura';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Asignatura = $val->getValor($campo);

        /*
         * Select_Carrera:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Carrera';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Carrera = $val->getValor($campo);

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

        /*
         * Select_Espacio:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Espacio';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Espacio = $val->getValor($campo);

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
            $this->_vista->curso->getAsignatura()->setId($select_Asignatura);
            $this->_vista->curso->getCarrera()->setId($select_Carrera);
            $this->_vista->curso->getGrupo()->setId($select_Grupo);
            $this->_vista->curso->getCiclo()->setId($select_Ciclo);
            $this->_vista->curso->setDescripcion($descripcion);
            $this->_vista->curso->getEspacio()->setId($select_Espacio);

            // listas
            $this->_vista->listaAsignaturas = $this->_vista->curso->getAsignatura()->lista();
            $this->_vista->listaCarreras = $this->_vista->curso->getCarrera()->lista();
            $this->_vista->listaGrupos = $this->_vista->curso->getGrupo()->lista();
            $this->_vista->listaCiclos = $this->_vista->curso->getCiclo()->lista();
            $this->_vista->listaEspacios = $this->_vista->curso->getEspacio()->lista();


            //redirigir a la vista
            $id ?
                            $this->_vista->render('curso/editar') :
                            $this->_vista->render('curso/nuevo');
        } else {
            // no se encontraron errores
            $curso = new Curso();

            $curso->getAsignatura()->setId($select_Asignatura);
            $curso->getCarrera()->setId($select_Carrera);
            $curso->getGrupo()->setId($select_Grupo);
            $curso->getCiclo()->setId($select_Ciclo);
            $curso->setDescripcion($descripcion);
            $curso->getEspacio()->setId($select_Espacio);

            if ($id == 0) {
                //insertar
                // comprobar que campo Uda, grupo, ciclo no repetido en curso
                if ($curso->existe($select_Asignatura, $select_Carrera, $select_Grupo, $select_Ciclo, $select_Espacio)) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $curso->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                $existe = $curso->existe($select_Asignatura, $select_Carrera, $select_Grupo, $select_Ciclo, $select_Espacio);
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }

                $curso->setId($id);
                $curso->actualizar();
            }

            $this->redireccionar("curso/index/{$curso->getEspacio()->getId()}");
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
        $this->redireccionar("curso/index/{$curso->getEspacio()->getId()}");
    }

    function _comprobar() {
        $esDisponible = false;

        $asignaturaId = $this->getEntero('Select_Asignatura');
        $carreraId = $this->getEntero('Select_Carrera');
        $grupoId = $this->getEntero('Select_Grupo');
        $cicloId = $this->getEntero('Select_Ciclo');
        $espacioId = $this->getEntero('Select_Espacio');
        $id = $this->getEntero('Id');

        //validar que campo Uda, grupo, ciclo no repetido en curso
        $curso = new Curso();
        $existe = $curso->existe($asignaturaId, $carreraId, $grupoId, $cicloId, $espacioId);
        if ($existe) {
            //curso existe
            if ($id != 0) {
                $curso->buscar($id);
                ($curso->getId() == $existe) ?
                                $esDisponible = true :
                                $esDisponible = false;
            } else {
                $esDisponible = false;
            }
        } else {
            $esDisponible = true;
        }

        echo json_encode(array('valid' => $esDisponible));
    }

}
