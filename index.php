<?php

// solucion a los acentos
header('Content-Type: text/html; charset=UTF-8');

try {
    require_once 'configuracion.php';
    require_once APP . 'AutoCarga.php';

    $aplicacion = new Ruteo;
    
    $aplicacion->iniciar();
    
} catch (Exception $e) {
    echo "hubo un error: ".$e->getMessage();
}