<?php

// Simpre colocar el slash / al final
define('ROOT', 'http://localhost/SiCLabS2015/');
define('DIR_ROOT' , realpath(dirname(__FILE__)) . '/');


define('APP', 'aplicacion/');
define('LIBS', 'librerias/');
define('MODELS', 'modelo/');


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bd_siclabs');
define('DB_USER', 'root');
define('DB_PASS', '');

// Llave unica para la generacion de cifrados
define('HASH_GENERAL_KEY', 'SiCLabS2014b');

// Llave para conreaseñas
define('HASH_PASSWORD_KEY', 'Cr34d0p0rR0qu3Ga14n_kdfue34562lsmcd');