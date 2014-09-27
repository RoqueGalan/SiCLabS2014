<?php

class Usuario extends Modelo{

    private $_Matricula;
    private $_Nombre;
    private $_ApellidoPaterno;
    private $_ApellidoMaterno;
    private $_Correo;
    private $_Contrasena;
    private $_Fotografia;
    private $_Rol;
    
    function __construct() {
        parent::__construct();
        $this->_Rol = new Rol();
    }
    
    function get_Matricula() {
        return $this->_Matricula;
    }

    function get_Nombre() {
        return $this->_Nombre;
    }

    function get_ApellidoPaterno() {
        return $this->_ApellidoPaterno;
    }

    function get_ApellidoMaterno() {
        return $this->_ApellidoMaterno;
    }

    function get_Correo() {
        return $this->_Correo;
    }

    function get_Contrasena() {
        return $this->_Contrasena;
    }

    function get_Fotografia() {
        return $this->_Fotografia;
    }

    function get_Rol() {
        return $this->_Rol;
    }

    function set_Matricula($Matricula) {
        $this->_Matricula = $Matricula;
    }

    function set_Nombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    function set_ApellidoPaterno($ApellidoPaterno) {
        $this->_ApellidoPaterno = $ApellidoPaterno;
    }

    function set_ApellidoMaterno($ApellidoMaterno) {
        $this->_ApellidoMaterno = $ApellidoMaterno;
    }

    function set_Correo($Correo) {
        $this->_Correo = $Correo;
    }

    function set_Contrasena($Contrasena) {
        $this->_Contrasena = $Contrasena;
    }

    function set_Fotografia($Fotografia) {
        $this->_Fotografia = $Fotografia;
    }

    function set_Rol($Rol) {
        $this->_Rol = $Rol;
    }

    

}

