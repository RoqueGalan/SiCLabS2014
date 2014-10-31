<?php

class noticiaControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'noticia');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Noticia-Lista';
        $noticia = new Noticia();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista Noticias
        $this->_vista->listaNoticias = $paginador->paginar($noticia->lista(), $pagina, 10);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'noticia/index');

        $this->_vista->render('noticia/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Noticia-Mostrar';
        $this->_vista->noticia = new Noticia();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->noticia->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->noticia->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("noticia/mostrar");
    }

    function nuevo() {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'noticia');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Noticia-Nuevo';
        $this->_vista->errorForm = array();
        $this->_vista->noticia = new Noticia();

        /* logica */
        $this->_vista->noticia->setId(0);
        // lista de espacios
        $this->_vista->listaEspacios = $this->_vista->noticia->getEspacio()->lista();

        $this->_vista->render('noticia/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('validarForm', 'noticia');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Noticia-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->noticia = new Noticia();

        /* logica */
        $this->_vista->noticia->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->noticia->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de espacios
        $this->_vista->listaEspacios = $this->_vista->noticia->getEspacio()->lista();

        $this->_vista->render('noticia/editar');
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
         * Titulo
         * Requerido
         * Alfanumerico
         * Rango (2,256)
         */
        $campo = 'Titulo';
        $val->requerido($campo);
        $val->alfanumerico($campo);
        $val->cadenaRango($campo, 2, 256, 1);
        $titulo = $val->getValor($campo);

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
            $this->_vista->setJs('validarForm', 'noticia');

            $this->_vista->noticia = new Noticia();

            $this->_vista->noticia->setId($id);
            $this->_vista->noticia->setTitulo($titulo);
            $this->_vista->noticia->setDescripcion($descripcion);
            $this->_vista->noticia->getEspacio()->setId($select_Espacio);

            //lista de espacios
            $this->_vista->listaEspacios = $this->_vista->noticia->getEspacio()->lista();


            //redirigir a la vista
            $id ?
                            $this->_vista->render('noticia/editar') :
                            $this->_vista->render('noticia/nuevo');
        } else {
            // no se encontraron errores
            $noticia = new Noticia();

            $noticia->setTitulo($titulo);
            $noticia->setDescripcion($descripcion);
            $noticia->getEspacio()->setId($select_Espacio);

            if ($id == 0) {
                //insertar
                $noticia->insertar();
            } else {
                //actualizar
                $noticia->setId($id);
                $noticia->actualizar();
            }

            $this->redireccionar('noticia/index');
        }
    }

    function eliminar($id) {
        $noticia = new Noticia();
        $noticia->buscar($id);

        // comprobar que el registro exista
        if ($noticia->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //eliminar la noticia y los archivos de las fotos
        //listar imagenesNoticia
        //eliminar las imagenes del disco
        $imgNoti = new ImagenNoticia();
        
        foreach ($imgNoti->lista($id) as $imagenNoticia) {
            @unlink(DIR_ROOT . $imagenNoticia->getRuta() . $imagenNoticia->getImagen());
            @unlink(DIR_ROOT . $imagenNoticia->getRuta() . 'mini/mini_' . $imagenNoticia->getImagen());
        }

        $noticia->eliminar($id);
        $this->redireccionar('noticia/index/');
    }

}
