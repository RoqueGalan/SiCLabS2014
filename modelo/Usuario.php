<?php

class Usuario extends Modelo {

    private $_Matricula;
    private $_Nombre;
    private $_Apellido;
    private $_Correo;
    private $_Contrasena;
    private $_Fotografia;
    private $_Rol;

    function __construct() {
        parent::__construct();
        $this->_Rol = new Rol();
    }

    function getMatricula() {
        return $this->_Matricula;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function getApellido() {
        return $this->_Apellido;
    }

    function getCorreo() {
        return $this->_Correo;
    }

    function getContrasena() {
        return $this->_Contrasena;
    }

    function getFotografia() {
        return $this->_Fotografia;
    }

    function getRol() {
        return $this->_Rol;
    }

    function setMatricula($Matricula) {
        $this->_Matricula = $Matricula;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    function setApellido($Apellido) {
        $this->_Apellido = $Apellido;
    }

    function setCorreo($Correo) {
        $this->_Correo = $Correo;
    }

    function setContrasena($Contrasena) {
        $this->_Contrasena = $Contrasena;
    }

    function setFotografia($Fotografia) {
        $this->_Fotografia = $Fotografia;
    }

    function setRol($Rol) {
        $this->_Rol = $Rol;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Usuario');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $usuario = new usuario();
            $usuario->setMatricula($temp['Matricula']);
            $usuario->setNombre($temp['Nombre']);
            $usuario->setApellido($temp['Apellido']);
            $usuario->setCorreo($temp['Correo']);
            $usuario->setContrasena($temp['Contraseña']);
            $usuario->setFotografia($temp['Fotografia']);
            $usuario->getRol()->buscar($temp['RolId']);

            $lista[] = $usuario;
        }

        return $lista;
    }

    public function existe($matricula) {
        $temp = $this->_db->select("SELECT Matricula FROM Usuario WHERE `Matricula` = '{$matricula}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Matricula'];
        } else {
            return 0;
        }
    }

    public function buscar($matricula) {
        $temp = $this->_db->select("SELECT * FROM Usuario WHERE `Matricula` = '{$matricula}' LIMIT 1");

        if (count($temp)) {
            $this->setMatricula($temp[0]['Matricula']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setApellido($temp[0]['Apellido']);
            $this->setCorreo($temp[0]['Correo']);
            $this->setContrasena($temp[0]['Contraseña']);
            $this->setFotografia($temp[0]['Fotografia']);
            $this->getRol()->buscar($temp[0]['RolId']);
        } else {
            $this->setMatricula('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Apellido' => $this->getApellido(),
            'Correo' => $this->getCorreo(),
            'Contrasena' => $this->getContrasena(),
            'Fotografia' => $this->getFotografia(),
            'RolId' => $this->getRol()->getId()
        );

        $this->_db->insert('Usuario', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Apellido' => $this->getApellido(),
            'Correo' => $this->getCorreo(),
            'Contrasena' => $this->getContrasena(),
            'Fotografia' => $this->getFotografia(),
            'RolId' => $this->getRol()->getId()
        );

        $donde = "`Matricula` = '{$this->getMatricula()}'";

        $this->_db->update('Rol', $parametros, $donde);
    }

    public function eliminar($matricula) {
        $this->_db->delete('Usuario', "`Matricula` = {$matricula}");
    }

}
