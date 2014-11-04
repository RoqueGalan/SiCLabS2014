<?php

class Controlador {

    var $_vista;

    function __construct() {
        $this->_vista = new Vista();
    }

    /**
     * 
     * @param string $nombre Nombre del Modelo
     */
    public function cargarModelo($nombre) {

        $ruta = ROOT . "modelo/" . $nombre . '.php';

        if (file_exists($ruta)) {

            require $ruta;

            $nombreModelo = $nombre;
            $this->_modelo = new $nombreModelo();
        }
    }

    protected function getTexto($datos) {
        if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
            $_POST[$datos] = htmlspecialchars($_POST[$datos], ENT_QUOTES);
            return $_POST[$datos];
        }

        return '';
    }

    protected function getEntero($datos) {
        if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
            $_POST[$datos] = filter_input(INPUT_POST, $datos, FILTER_VALIDATE_INT);
            return $_POST[$datos];
        }

        return 0;
    }

//
//    protected function getSql($datos) {
//        if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
//            $_POST[$datos] = strip_tags($_POST[$datos]);
//
//            if (!get_magic_quotes_gpc()) {
//                $_POST[$datos] = mysql_real_escape_string($_POST[$datos], mysql_connect(DB_HOST, DB_USER, DB_PASS));
//            }
//
//            return trim($_POST[$datos]);
//        }
//    }
//
    protected function redireccionar($ruta = false) {
        if ($ruta) {
            header('location:' . ROOT . $ruta);
            exit;
        } else {
            header('location:' . ROOT);
            exit;
        }
    }

    protected function filtrarEntero($entero) {
        $entero = (int) $entero;

        if (is_int($entero)) {
            return $entero;
        } else {
            return 0;
        }
    }

//
//    protected function getPostParametro($datos) {
//        if (isset($_POST[$datos])) {
//            return $_POST[$datos];
//        }
//    }
//    public function validarEmail($email) {
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            return false;
//        }
//
//        return true;
//    }

    function subirImagen($campo, $ruta) {
        $imagen = '';
        if ($_FILES[$campo]['name']) {
            $ruta = DIR_ROOT . $ruta;

            $upload = new upload($_FILES[$campo], 'es_Es');
            $upload->allowed = array('image/*');
            $upload->file_new_name_body = 'img-' . uniqid();
            $upload->_mkdir($ruta);
            $upload->_mkdir($ruta . '/mini');
            $upload->process($ruta);

            if ($upload->processed) {
                $thumb = new upload($upload->file_dst_pathname);
                $thumb->image_resize = true;
                $thumb->image_ratio_x = true;
                $thumb->image_y = 100;
                $thumb->file_name_body_pre = 'mini_';
                $thumb->process($ruta . 'mini/');

                $imagen = $upload->file_dst_name;
                $upload->clean();
            }
        }
        return $imagen;
    }

    function subirArchivo($campo, $ruta) {
        $archivo = 0;
        if ($_FILES[$campo]['name']) {
            $ruta = DIR_ROOT . $ruta;

            $upload = new upload($_FILES[$campo], 'es_Es');
            $upload->allowed = array('application/*');
            $upload->file_new_name_body = 'doc-' . uniqid();
            $upload->_mkdir($ruta);
            $upload->process($ruta);

            if ($upload->processed) {
                $archivo = $upload->file_dst_name;
            }
        }
        return $archivo;
    }

}
