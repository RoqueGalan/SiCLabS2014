<?php

class imagenNoticiaControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($noticiaId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'ImagenNoticia');
        $this->_vista->setJs('abrirImagenPop');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'ImagenNoticia-Lista';
        $noticiaId = $this->filtrarEntero($noticiaId);
        $this->_vista->noticia = new Noticia();
        $imagenNoticia = new ImagenNoticia();
        $paginador = new Paginador();

        /* logica */
        $imagenNoticia->setNoticiaId($noticiaId);
        $this->_vista->noticia->buscar($noticiaId);
        // comprobar que el registro exista
        if ($this->_vista->noticia->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;

        //lista Espacio
        $this->_vista->listaImagenNoticia = $paginador->paginar($imagenNoticia->lista($noticiaId), $pagina, 5);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'imagenNoticia/index/' . $noticiaId);

        $this->_vista->render('imagenNoticia/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'ImagenNoticia-Mostrar';
        $this->_vista->imagenNoticia = new ImagenNoticia();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->imagenNoticia->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->imagenNoticia->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("imagenNoticia/mostrar");
    }

    function nuevo($noticiaId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('jasny-bootstrap.min');
        $this->_vista->setJs('jasny-bootstrap.min');
        $this->_vista->setJs('validarForm', 'imagenNoticia');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'ImagenNoticia-Nuevo';
        $this->_vista->errorForm = array();
        $noticiaId = $this->filtrarEntero($noticiaId);
        $this->_vista->imagenNoticia = new ImagenNoticia();

        /* logica */
        $this->_vista->imagenNoticia->setId(0);
        $this->_vista->imagenNoticia->setNoticiaId($noticiaId);

        $this->_vista->render('imagenNoticia/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('jasny-bootstrap.min');
        $this->_vista->setJs('jasny-bootstrap.min');
        $this->_vista->setJs('validarForm', 'imagenNoticia');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'ImagenNoticia-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->imagenNoticia = new ImagenNoticia();

        /* logica */
        $this->_vista->imagenNoticia->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->imagenNoticia->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render('imagenNoticia/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $imagenNoticia = new ImagenNoticia();

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
         * Alfanumerico
         * Rango (2,256)
         */
        $campo = 'Titulo';
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
         * NoticiaId
         * Numerico
         */
        $campo = 'NoticiaId';
        $val->requerido($campo);
        $val->numerico($campo);
        $noticiaId = $val->getValor($campo);

        /*
         * Imagen:
         * Requerido
         * imagen
         */
        $campo = 'Imagen';
        $imagen = $val->imagen($campo, $imagenNoticia->getRuta(), true);

        //errores
        $this->_vista->errorForm = $val->getErrorLista();

        if (count($this->_vista->errorForm)) {
            // se encontraron errores
            /* script o css a utilizar por la vista */
            $this->_vista->setCss('bootstrapValidator.min');
            $this->_vista->setJs('bootstrapValidator.min');
            $this->_vista->setCss('jasny-bootstrap.min');
            $this->_vista->setJs('jasny-bootstrap.min');
            $this->_vista->setJs('validarForm', 'imagenNoticia');

            $this->_vista->imagenNoticia = new ImagenNoticia();

            $this->_vista->imagenNoticia->setId($id);
            $this->_vista->imagenNoticia->setTitulo($titulo);
            $this->_vista->imagenNoticia->setDescripcion($descripcion);
            $this->_vista->imagenNoticia->setNoticiaId($noticiaId);

            //redirigir a la vista
            $id ?
                            $this->_vista->render('imagenNoticia/editar') :
                            $this->_vista->render('imagenNoticia/nuevo');
        } else {
            // no se encontraron errores

            $imagenNoticia->setTitulo($titulo);
            $imagenNoticia->setDescripcion($descripcion);
            $imagenNoticia->setNoticiaId($noticiaId);
            $imagenNoticia->setImagen($this->getTexto('ImagenDefault'));

            // si imagen FILE lleno
            if ($imagen == 1) {
                //eliminar las fotos 
                @unlink(DIR_ROOT . $imagenNoticia->getRuta() . $imagenNoticia->getImagen());
                @unlink(DIR_ROOT . $imagenNoticia->getRuta() . 'mini/mini_' . $imagenNoticia->getImagen());
                $imagenNoticia->setImagen($this->subirImagen('Imagen', $imagenNoticia->getRuta()));
            }

            if ($id == 0) {
                //insertar
                $imagenNoticia->insertar();
            } else {
                //actualizar
                $imagenNoticia->setId($id);

                $imagenNoticia->actualizar();
            }

            $this->redireccionar('imagenNoticia/index/' . $imagenNoticia->getNoticiaId());
        }
    }

    function eliminar($id) {
        $imagenNoticia = new ImagenNoticia();
        $imagenNoticia->buscar($id);

        // comprobar que el registro exista
        if ($imagenNoticia->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $imagenNoticia->eliminar($id);
        //eliminar las imagenes del disco
        @unlink(DIR_ROOT . $imagenNoticia->getRuta() . $imagenNoticia->getImagen());
        @unlink(DIR_ROOT . $imagenNoticia->getRuta() . 'mini/mini_' . $imagenNoticia->getImagen());

        $this->redireccionar('imagenNoticia/index/' . $imagenNoticia->getNoticiaId());
    }

}
