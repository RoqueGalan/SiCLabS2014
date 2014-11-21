<?php

// solucion a los acentos
header('Content-Type: text/html; charset=UTF-8');

try {
    require_once 'configuracion.php';
    require_once APP . 'AutoCarga.php';

    $aplicacion = new Ruteo;
    
    $aplicacion->iniciar();
    
} catch (Exception $e) {
    echo "<h1>Error en Aplicación</h1>";
    echo "<br>";
    echo "Archivo: <br>".$e->getFile();
    echo "<br>";
    echo "<br>";
    echo "Linea: <br>".$e->getLine();
    echo "<br>";
    echo "<br>";
    echo "Mensaje: <br>".$e->getMessage();
    echo "<br>";
    echo "<br>";
    echo "Trace: <br>".$e->getTraceAsString();
}