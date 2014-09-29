<?php


class Vista{

    function __construct() {
        //echo 'this is the view';
    }

    public function render($nombre , $plantilla = 'default') {

        require 'vista/plantillas/'.$plantilla.'/header.php';
      
        require 'vista/' . $nombre . '.php';
        
        require 'vista/plantillas/'.$plantilla.'/footer.php';
    }

}
