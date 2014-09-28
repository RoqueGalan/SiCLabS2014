<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('ROOT', 'http://192.168.0.3/SiCLabS2014/');


define('APP', 'aplicacion/');
define('LIBS', 'librerias/');
define('MODELS', 'modelo/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bd_siclabs');
define('DB_USER', 'root');
define('DB_PASS', '');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'SiCLabS2014b');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'Cr34d0p0rR0qu3Ga14n_kdfue34562lsmcd');