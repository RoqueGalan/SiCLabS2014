<?php

class Usuario extends Modelo {

    private $_Id;
    private $_Matricula;
    private $_Nombre;
    private $_Apellido;
    private $_Correo;
    private $_Contrasena;
    private $_Rol;

    function __construct() {
        parent::__construct();
        $this->_Rol = new Rol();
    }

    function getId() {
        return $this->_Id;
    }

    function setId($Id) {
        $this->_Id = $Id;
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

    function setRol($Rol) {
        $this->_Rol = $Rol;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Usuario ORDER BY `Matricula` ASC');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $usuario = new usuario();
            $usuario->setId($temp['Id']);
            $usuario->setMatricula($temp['Matricula']);
            $usuario->setNombre($temp['Nombre']);
            $usuario->setApellido($temp['Apellido']);
            $usuario->setCorreo($temp['Correo']);
            $usuario->setContrasena($temp['Contrasena']);
            $usuario->getRol()->buscar($temp['RolId']);

            $lista[] = $usuario;
        }

        return $lista;
    }

    public function existe($matricula) {
        $temp = $this->_db->select("SELECT Id FROM Usuario WHERE `Matricula` = '{$matricula}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Usuario WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setMatricula($temp[0]['Matricula']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setApellido($temp[0]['Apellido']);
            $this->setCorreo($temp[0]['Correo']);
            $this->setContrasena($temp[0]['Contrasena']);
            $this->getRol()->buscar($temp[0]['RolId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Matricula' => $this->getMatricula(),
            'Nombre' => $this->getNombre(),
            'Apellido' => $this->getApellido(),
            'Correo' => $this->getCorreo(),
            'Contrasena' => $this->getContrasena(),
            'RolId' => $this->getRol()->getId()
        );

        return $this->_db->insert('Usuario', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Apellido' => $this->getApellido(),
            'Correo' => $this->getCorreo(),
            'Contrasena' => $this->getContrasena(),
            'RolId' => $this->getRol()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Usuario', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Usuario', "`Id` = {$id}");
    }

}
