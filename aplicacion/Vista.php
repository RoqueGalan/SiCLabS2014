<?php


class Vista{

    function __construct() {
        //echo 'this is the view';
    }

    public function render($nombre , $plantilla = 'default') {
        //aplicar try para errores
        require_once DIR_ROOT . 'vista/plantillas/'.$plantilla.'/header.php';
        
        
        $vista = DIR_ROOT . 'vista/' . $nombre . '.php';
        if(is_readable($vista)){
            require_once $vista;
        }else{
            header('location:' . ROOT . 'error/tipo/Pagina_NoExiste');
        }
        
        
        require_once DIR_ROOT . 'vista/plantillas/'.$plantilla.'/footer.php';    
        

        
    }

}
