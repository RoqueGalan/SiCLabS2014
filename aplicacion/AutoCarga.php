<?php

function autoCargaNucleo($clase){ 
    if(file_exists(APP . $clase . '.php')){
        include_once APP . $clase . '.php';
    }
}

function autoCargaLibrerias($clase){ 
    if(file_exists(LIBS . $clase . '.php')){
        include_once LIBS . $clase . '.php';
    }
}

function autoCargaModelos($modelo) {
    if(file_exists(MODELS . $modelo . '.php')){
        include_once MODELS . $modelo . '.php';
    }
}

spl_autoload_register("autoCargaNucleo");
spl_autoload_register("autoCargaLibrerias");
spl_autoload_register("autoCargaModelos");


