<?php

class horarioCursoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($CursoId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'horarioCurso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Horario-Lista';
        $CursoId = $this->filtrarEntero($CursoId);
        $horario = new HorarioCurso();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Rol
        $horario->getCurso()->buscar($CursoId);
        // comprobar que el registro exista
        if ($horario->getCurso()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->curso = $horario->getCurso();
        //lista Equipo
        $this->_vista->listaHorarios = $paginador->paginar($horario->lista($CursoId), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'horarioCurso/index/' . $horario->getCurso()->getId());

        $this->_vista->render('horarioCurso/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Horario-Mostrar';
        $this->_vista->horario = new HorarioCurso();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->horario->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->horario->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("horarioCurso/mostrar");
    }

    function nuevo($CursoId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'horarioCurso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Horario-Nuevo';
        $CursoId = $this->filtrarEntero($CursoId);
        $this->_vista->errorForm = array();
        $this->_vista->horario = new HorarioCurso();

        /* logica */
        $this->_vista->horario->getCurso()->buscar($CursoId);
        // comprobar que el registro exista
        if ($this->_vista->horario->getCurso()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->horario->setId(0);

        // lista de cursos
        $this->_vista->listaCursos = $this->_vista->horario->getCurso()->lista($this->_vista->horario->getCurso()->getEspacio()->getId());

        $this->_vista->render('horarioCurso/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'horarioCurso');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Horario-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->horario = new HorarioCurso();

        /* logica */
        $this->_vista->horario->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->horario->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        // lista de cursos
        $this->_vista->listaCursos = $this->_vista->horario->getCurso()->lista($this->_vista->horario->getCurso()->getEspacio()->getId());

        $this->_vista->render('horarioCurso/nuevo');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $horario = new HorarioCurso();

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
         * Dia:
         * Requerido
         * Solo acepta: 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'
         */
        $campo = 'Select_Dia';
        $val->requerido($campo);
        $val->compararPalabras($campo, $arreglo = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'));
        $select_Dia = $val->getValor($campo);

        /*
         * Inicio:
         * Requerido
         * Tiempo
         * Rango: 7:00 a 21:00
         * Menor a Fin
         */
        $campo = 'Inicio';
        $val->requerido($campo);
        $val->tiempo($campo);
        $val->rangoTiempo('07:00:00', '09:00:00', $campo);
        $val->menorTiempo($campo, 'Fin');
        $inicio = $val->getValor($campo);

        /*
         * Fin:
         * Requerido
         * Tiempo
         * Rango: 7:00 a 21:00
         */
        $campo = 'Fin';
        $val->requerido($campo);
        $val->tiempo($campo);
        $val->rangoTiempo('07:00:00', '09:00:00', $campo);
        $fin = $val->getValor($campo);

        /*
         * Select_Curso:
         * Requerido
         * Numerico
         */
        $campo = 'Select_Curso';
        $val->requerido($campo);
        $val->numerico($campo);
        $select_Curso = $val->getValor($campo);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('validarForm', 'horarioCurso');

            $horario->setId($id);
            $horario->setDia($select_Dia);
            $horario->setInicio($inicio);
            $horario->setFin($fin);
            $horario->getCurso()->buscar($select_Curso);

            $this->_vista->horario = $horario;

            /// lista de cursos
            $this->_vista->listaCursos = $horario->getCurso()->lista($horario->getCurso()->getEspacio()->getId());

            //redirigir a la vista
            $id ?
                            $this->_vista->render('horarioCurso/editar') :
                            $this->_vista->render('horarioCurso/nuevo');
        } else {
            // no se encontraron errores
            $horario->setDia($select_Dia);
            $horario->setInicio($inicio);
            $horario->setFin($fin);
            $horario->getCurso()->buscar($select_Curso);

            if ($id == 0) {
                //insertar
                // comprobar campo Uda no repetido en Carrera
                if ($horario->existe($inicio, $fin, $select_Dia, $horario->getCurso()->getEspacio()->getId())) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $horario->insertar();
            } else {
                //actualizar
                /*
                 * Validar Repetido:
                 * No Repetido
                 */
                $existe = $horario->existe($inicio, $fin, $select_Dia, $horario->getCurso()->getEspacio()->getId());
                if ($existe != $id && $existe != 0) {
                    $this->redireccionar('error/tipo/Registro_SiExiste');
                }
                $horario->setId($id);
                $horario->actualizar();
            }

            $this->redireccionar("horarioCurso/index/{$horario->getCurso()->getId()}");
        }
    }

    function eliminar($id) {
        $horario = new HorarioCurso();
        $horario->buscar($id);
        // comprobar que el registro exista
        if ($horario->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $horario->eliminar($id);

        $this->redireccionar("horarioCurso/index/{$horario->getCurso()->getId()}");
    }

}
