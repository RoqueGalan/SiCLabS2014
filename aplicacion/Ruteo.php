<?php

class Ruteo {

    private $_url = null;
    private $_controlador = null;
    
    private $_RutaControlador = 'controlador/'; // Always include trailing slash
    private $_RutaModelo = 'modelo/'; // Always include trailing slash
    private $_ArchivoError = 'errorControlador.php';
    private $_ArchivoDefault = 'indexControlador.php';
    
    /**
     * Starts the Bootstrap
     * 
     * @return boolean
     */
    public function iniciar()
    {
        // Sets the protected $_url
        $this->_getUrl();

        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        
     
        if (empty($this->_url[0])) {
           
            
            $this->_CargarControladorDefault();
            return false;
        }

        $this->_CargarControladorExistente();
        $this->_LlamarMetodoDelControlador();
    }
    
    /**
     * (Optional) Set a custom path to controllers
     * @param string $ruta
     */
    public function setRutaControlador($ruta)
    {
        $this->_RutaControlador = trim($ruta, '/') . '/';
    }
    
    /**
     * (Optional) Set a custom path to models
     * @param string $ruta
     */
    public function setRutaModelo($ruta)
    {
        $this->_RutaModelo = trim($ruta, '/') . '/';
    }
    
    /**
     * (Optional) Set a custom path to the error file
     * @param string $ruta Use the file name of your controller, eg: error.php
     */
    public function setArchivoError($ruta)
    {
        $this->_ArchivoError = trim($ruta, '/');
    }
    
    /**
     * (Optional) Set a custom path to the error file
     * @param string $ruta Use the file name of your controller, eg: index.php
     */
    public function setArchivoDefault($ruta)
    {
        $this->_ArchivoDefault = trim($ruta, '/');
    }
    
    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }
    
    /**
     * This loads if there is no GET parameter passed
     */
    private function _CargarControladorDefault()
    {
        
        require $this->_RutaControlador . $this->_ArchivoDefault;
        
        
        $this->_controlador = new IndexControlador();
        $this->_controlador->index();
    }
    
    /**
     * Load an existing controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
    private function _CargarControladorExistente()
    {
        $archivo = $this->_RutaControlador . $this->_url[0] . 'Controlador.php';
        
        if (file_exists($archivo)) {
            require $archivo;
            
            $controlador = $this->_url[0] . 'Controlador';
            
            $this->_controlador = new $controlador;
            $this->_controlador->CargarModelo($controlador);
        } else {
            $this->_error();
            return false;
        }
    }
    
    /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _LlamarMetodoDelControlador()
    {
        $longitud = count($this->_url);
        
        // Make sure the method we are calling exists
        if ($longitud > 1) {
            if (!method_exists($this->_controlador, $this->_url[1])) {
                $this->_error();
            }
        }
        
        // Determine what to load
        switch ($longitud) {
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controlador->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            
            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controlador->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            
            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controlador->{$this->_url[1]}($this->_url[2]);
                break;
            
            case 2:
                //Controller->Method(Param1, Param2)
                $this->_controlador->{$this->_url[1]}();
                break;
            
            default:
                $this->_controlador->index();
                break;
        }
    }
    
    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error() {
        require $this->_RutaControlador . $this->_ArchivoError;
        $this->_controlador = new ErrorControlador();
        $this->_controlador->index();
        exit;
    }

}