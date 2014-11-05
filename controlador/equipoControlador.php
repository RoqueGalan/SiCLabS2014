<?php

class equipoControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($EspacioId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'equipo');
        $this->_vista->setJs('abrirImagenPop');
        $this->_vista->setJs('abrirDocumentoPop');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Equipo-Lista';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $equipo = new Equipo();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Rol
        $equipo->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($equipo->getEspacio()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->espacio = $equipo->getEspacio();
        //lista Equipo
        $this->_vista->listaEquipo = $paginador->paginar($equipo->lista($EspacioId), $pagina, 5);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'equipo/index/' . $equipo->getEspacio()->getId());

        $this->_vista->render('equipo/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('abrirImagenPop');
        $this->_vista->setJs('abrirDocumentoPop');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Equipo-Mostrar';
        $this->_vista->equipo = new Equipo();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->equipo->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->equipo->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("equipo/mostrar");
    }

    function nuevo($EspacioId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setCss('jasny-bootstrap.min');
        $this->_vista->setJs('jasny-bootstrap.min');
        $this->_vista->setJs('validarForm', 'equipo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Equipo-Nuevo';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $this->_vista->errorForm = array();
        $this->_vista->equipo = new Equipo();

        /* logica */
        $this->_vista->equipo->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($this->_vista->equipo->getEspacio()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->equipo->setId(0);

        // lista de espacios
        $this->_vista->listaEspacios = $this->_vista->equipo->getEspacio()->lista();

        $this->_vista->render('equipo/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setCss('jasny-bootstrap.min');
        $this->_vista->setJs('jasny-bootstrap.min');
        $this->_vista->setJs('validarForm', 'equipo');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Equipo-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->equipo = new Equipo();

        /* logica */
        $this->_vista->equipo->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->equipo->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de espacios
        $this->_vista->listaEspacios = $this->_vista->equipo->getEspacio()->lista();

        $this->_vista->render('equipo/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $equipo = new Equipo();

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
         * Nombre
         * Requerido
         * Rango (1,64)
         */
        $campo = 'Nombre';
        $val->requerido($campo);
        $val->cadenaRango($campo, 1, 64, 1);
        $nombre = $val->getValor($campo);

        /*
         * Marca
         * Rango (0,32)
         */
        $campo = 'Marca';
        $val->cadenaRango($campo, 0, 32, 1);
        $marca = $val->getValor($campo);

        /*
         * Modelo
         * Rango (0,32)
         */
        $campo = 'Modelo';
        $val->cadenaRango($campo, 0, 32, 1);
        $modelo = $val->getValor($campo);

        /*
         * NoSerie
         * Rango (0,32)
         */
        $campo = 'NoSerie';
        $val->cadenaRango($campo, 0, 32, 1);
        $noSerie = $val->getValor($campo);

        /*
         * Select-Condicion:
         * Requerido
         * Solo acepta: 'Excelente', 'Bueno' , 'Regular', 'Malo', 'Pesimo'
         */
        $campo = 'Select_Condicion';
        $val->requerido($campo);
        $val->compararPalabras($campo, $arreglo = array('Excelente', 'Bueno', 'Regular', 'Malo', 'Pesimo'));
        $select_Condicion = $val->getValor($campo);

        /*
         * Caracteristicas
         */
        $campo = 'Caracteristicas';
        $caracteristicas = $val->getValor($campo);

        /*
         * CantidadTotal
         * Requerido
         */
        $campo = 'CantidadTotal';
        $val->requerido($campo);
        $val->numerico($campo, 'double');
        $val->numeroLongitud($campo, '>=', 1, 'double');
        $cantidadTotal = $val->getValor($campo);

        /*
         * CodigoNacion
         * Rango (0,64)
         */
        $campo = 'CodigoNacion';
        $val->cadenaRango($campo, 0, 64, 1);
        $codigoNacion = $val->getValor($campo);

        /*
         * CodigoUaem
         * Rango (0,32)
         */
        $campo = 'CodigoUaem';
        $val->cadenaRango($campo, 0, 32, 1);
        $codigoUaem = $val->getValor($campo);

        /*
         * Imagen:
         * imagen
         */
        $campo = 'Imagen';
        $imagen = $val->imagen($campo, $equipo->getRutaImg(), false);


        /*
         * Documento:
         * *Todo tipo de documentos
         */
        $campo = 'Documento';
        $archivo = $val->archivo($campo, $equipo->getRutaDoc(), false);

        /*
         * Select-Oculto:
         * Requerido
         * Solo acepta: 'Visible', 'Oculto'
         */
        $campo = 'Select_Oculto';
        $val->requerido($campo);
        $val->compararPalabras($campo, $arreglo = array('Visible', 'Oculto'));
        $select_Oculto = $val->getValor($campo);

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
            $this->_vista->setCss('jasny-bootstrap.min');
            $this->_vista->setJs('jasny-bootstrap.min');
            $this->_vista->setJs('validarForm', 'equipo');

            $equipo->setId($id);
            $equipo->setNombre($nombre);
            $equipo->setMarca($marca);
            $equipo->setModelo($modelo);
            $equipo->setNoSerie($noSerie);
            $equipo->setCondicion($select_Condicion);
            $equipo->setCaracteristicas($caracteristicas);
            $equipo->setCantidadTotal($cantidadTotal);
            $equipo->setCodigoNacion($codigoNacion);
            $equipo->setCodigoUaem($codigoUaem);
            $equipo->setOculto($select_Oculto);
            $equipo->getEspacio()->setId($select_Espacio);

            $this->_vista->equipo = $equipo;

            //lista de espacios
            $this->_vista->listaEspacios = $equipo->getEspacio()->lista();

            //redirigir a la vista
            $id ?
                            $this->_vista->render('equipo/editar') :
                            $this->_vista->render('equipo/nuevo');
        } else {
            // no se encontraron errores
            $equipo->setNombre($nombre);
            $equipo->setMarca($marca);
            $equipo->setModelo($modelo);
            $equipo->setNoSerie($noSerie);
            $equipo->setCondicion($select_Condicion);
            $equipo->setCaracteristicas($caracteristicas);
            $equipo->setCantidadTotal($cantidadTotal);
            $equipo->setCodigoNacion($codigoNacion);
            $equipo->setCodigoUaem($codigoUaem);
            //imagen
            $equipo->setImagen($this->getTexto('ImagenDefault'));
            // si imagen FILE lleno
            if ($imagen == 1) {
                //eliminar las fotos 
                @unlink(DIR_ROOT . $equipo->getRutaImg() . $equipo->getImagen());
                @unlink(DIR_ROOT . $equipo->getRutaImg() . 'mini/mini_' . $equipo->getImagen());
                $equipo->setImagen($this->subirImagen('Imagen', $equipo->getRutaImg()));
            }
            //documento
            $equipo->setDocumento($this->getTexto('DocumentoDefault'));
            // si FILE lleno
            if ($archivo == 1) {
                //eliminar los archivos
                @unlink(DIR_ROOT . $equipo->getRutaDoc() . $equipo->getDocumento());
                $equipo->setDocumento($this->subirArchivo('Documento', $equipo->getRutaDoc()));
            }
            $equipo->setOculto($select_Oculto);
            $equipo->getEspacio()->setId($select_Espacio);

            if ($id == 0) {
                //insertar
                $equipo->setCantidadDisponible($cantidadTotal);
                $equipo->insertar();
            } else {
                //actualizar
                $equipo->setId($id);

                //realizar el balance de la cantidad disponible
                // actual[temp]     = 30
                // nuevo[equipo]    = 50
                // ajuste           = 50-30 = 20
                //
                // actual[temp]     = 80
                // nuevo[equipo]    = 50
                // ajuste           = 50-80 = -30 

                $temp = new Equipo();
                $temp->buscar($equipo->getId());
                $ajuste = $equipo->getCantidadTotal() - $temp->getCantidadTotal();
                $disponibles = $temp->getCantidadDisponible() + $ajuste;

                $equipo->setCantidadDisponible($disponibles);

                if ($equipo->getCantidadDisponible() >= 0) {
                    $equipo->actualizar();
                }
            }

            $this->redireccionar("equipo/index/{$equipo->getEspacio()->getId()}");
        }
    }

}
