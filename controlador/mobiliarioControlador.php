<?php

class mobiliarioControlador extends Controlador {

    function __construct() {
        parent::__construct();
    }

    function index($EspacioId, $pagina = false) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('botonEliminar', 'mobiliario');
        $this->_vista->setJs('abrirImagenPop');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Mobiliario-Lista';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $mobiliario = new Mobiliario();
        $paginador = new Paginador();

        /* logica */
        //Numero de pagina
        $this->filtrarEntero($pagina) ? $pagina = (int) $pagina : $pagina = false;
        // buscar el Rol
        $mobiliario->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($mobiliario->getEspacio()->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        //id Espacio
        $this->_vista->espacio = $mobiliario->getEspacio();
        //lista Equipo
        $this->_vista->listaMobiliario = $paginador->paginar($mobiliario->lista($EspacioId), $pagina, 5);
        //numero de pagina a renderizar
        $this->_vista->paginacion = $paginador->getVista('prueba', 'mobiliario/index/' . $mobiliario->getEspacio()->getId());

        $this->_vista->render('mobiliario/index');
    }

    function mostrar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('abrirImagenPop');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Equipo-Mostrar';
        $this->_vista->mobiliario = new Mobiliario();
        $id = $this->filtrarEntero($id);

        /* logica */
        $this->_vista->mobiliario->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->mobiliario->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        $this->_vista->render("mobiliario/mostrar");
    }

    function nuevo($EspacioId) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setCss('jasny-bootstrap.min');
        $this->_vista->setJs('jasny-bootstrap.min');
        $this->_vista->setJs('validarForm', 'mobiliario');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Mobiliario-Nuevo';
        $EspacioId = $this->filtrarEntero($EspacioId);
        $this->_vista->errorForm = array();
        $this->_vista->mobiliario = new Mobiliario();

        /* logica */
        $this->_vista->mobiliario->getEspacio()->buscar($EspacioId);
        // comprobar que el registro exista
        if ($this->_vista->mobiliario->getEspacio()->getId() == '-1') {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }
        $this->_vista->mobiliario->setId(0);

        // lista de espacios
        $this->_vista->listaEspacios = $this->_vista->mobiliario->getEspacio()->lista();

        $this->_vista->render('mobiliario/nuevo');
    }

    function editar($id) {
        /* script o css a utilizar por la vista */
        $this->_vista->setJs('bootstrapValidator.min');
        $this->_vista->setCss('bootstrapValidator.min');
        $this->_vista->setCss('jasny-bootstrap.min');
        $this->_vista->setJs('jasny-bootstrap.min');
        $this->_vista->setJs('validarForm', 'mobiliario');

        /* declarar e inicializar variables */
        $this->_vista->titulo = 'Mobiliario-Editar';
        $this->_vista->errorForm = array();
        $id = $this->filtrarEntero($id);
        $this->_vista->mobiliario = new Mobiliario();

        /* logica */
        $this->_vista->mobiliario->buscar($id);

        // comprobar que el registro exista
        if ($this->_vista->mobiliario->getId() == -1) {
            $this->redireccionar('error/tipo/Registro_NoExiste');
        }

        //lista de espacios
        $this->_vista->listaEspacios = $this->_vista->mobiliario->getEspacio()->lista();

        $this->_vista->render('mobiliario/editar');
    }

    function _guardar($id) {
        /* declarar e inicializar variables */
        $this->_vista->errorForm = array();
        $val = new Validador($_POST);
        $mobiliario = new Mobiliario();

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
        $imagen = $val->imagen($campo, $mobiliario->getRutaImg(), false);

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
            $this->_vista->setJs('validarForm', 'mobiliario');

            $mobiliario->setId($id);
            $mobiliario->setNombre($nombre);
            $mobiliario->setMarca($marca);
            $mobiliario->setModelo($modelo);
            $mobiliario->setNoSerie($noSerie);
            $mobiliario->setCondicion($select_Condicion);
            $mobiliario->setCaracteristicas($caracteristicas);
            $mobiliario->setCantidadTotal($cantidadTotal);
            $mobiliario->setCodigoNacion($codigoNacion);
            $mobiliario->setCodigoUaem($codigoUaem);
            $mobiliario->setOculto($select_Oculto);
            $mobiliario->getEspacio()->setId($select_Espacio);

            $this->_vista->mobiliario = $mobiliario;

            //lista de espacios
            $this->_vista->listaEspacios = $mobiliario->getEspacio()->lista();

            //redirigir a la vista
            $id ?
                            $this->_vista->render('mobiliario/editar') :
                            $this->_vista->render('mobiliario/nuevo');
        } else {

            // no se encontraron errores
            $mobiliario->setNombre($nombre);
            $mobiliario->setMarca($marca);
            $mobiliario->setModelo($modelo);
            $mobiliario->setNoSerie($noSerie);
            $mobiliario->setCondicion($select_Condicion);
            $mobiliario->setCaracteristicas($caracteristicas);
            $mobiliario->setCantidadTotal($cantidadTotal);
            $mobiliario->setCodigoNacion($codigoNacion);
            $mobiliario->setCodigoUaem($codigoUaem);
            //imagen
            $mobiliario->setImagen($this->getTexto('ImagenDefault'));
            // si imagen FILE lleno
            if ($imagen == 1) {
                //eliminar las fotos 
                @unlink(DIR_ROOT . $mobiliario->getRutaImg() . $mobiliario->getImagen());
                @unlink(DIR_ROOT . $mobiliario->getRutaImg() . 'mini/mini_' . $mobiliario->getImagen());
                $mobiliario->setImagen($this->subirImagen('Imagen', $mobiliario->getRutaImg()));
            }

            $mobiliario->setOculto($select_Oculto);
            $mobiliario->getEspacio()->setId($select_Espacio);

            if ($id == 0) {
                //insertar
                $mobiliario->setCantidadDisponible($cantidadTotal);
                $mobiliario->insertar();
            } else {
                //actualizar
                $mobiliario->setId($id);

                //realizar el balance de la cantidad disponible
                // actual[temp]     = 30
                // nuevo[equipo]    = 50
                // ajuste           = 50-30 = 20
                //
                // actual[temp]     = 80
                // nuevo[equipo]    = 50
                // ajuste           = 50-80 = -30 

                $temp = new Mobiliario();
                $temp->buscar($mobiliario->getId());
                $ajuste = $mobiliario->getCantidadTotal() - $temp->getCantidadTotal();
                $disponibles = $temp->getCantidadDisponible() + $ajuste;

                $mobiliario->setCantidadDisponible($disponibles);

                if ($mobiliario->getCantidadDisponible() >= 0) {
                    $mobiliario->actualizar();
                }
            }

            $this->redireccionar("mobiliario/index/{$mobiliario->getEspacio()->getId()}");
        }
    }

}
