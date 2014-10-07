<?php

class Vista {

    var $_js = array();
    var $_css = array();

    function __construct() {
    }

    public function render($nombre, $plantilla = 'default') {
        //aplicar try para errores
        require_once DIR_ROOT . 'vista/plantillas/' . $plantilla . '/header.php';
        $vista = DIR_ROOT . 'vista/' . $nombre . '.php';
        if (is_readable($vista)) {
            require_once $vista;
        } else {
            header('location:' . ROOT . 'error/tipo/Pagina_NoExiste');
        }
        require_once DIR_ROOT . 'vista/plantillas/' . $plantilla . '/footer.php';
    }

    public function setJs($javaScript, $vista = false) {
        if ($vista) {
            $ruta = ROOT . 'vista/' . $vista . '/js/';
        } else {
            $ruta = ROOT . 'public/js/';
        }
        $this->_js[] = $ruta . $javaScript . '.js';
    }

    public function setCss($css, $vista = false) {
        if ($vista) {
            $ruta = ROOT . 'vista/' . $vista . '/css/';
        } else {
            $ruta = ROOT . 'public/css/';
        }
        $this->_css[] = $ruta . $css . '.css';
    }

    
}
