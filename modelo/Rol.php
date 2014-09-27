<?php

class Rol extends Modelo {

    private $_Id;
    private $_Nombre;

    function __construct() {
        parent::__construct();
    }

    function get_Id() {
        return $this->_Id;
    }

    function get_Nombre() {
        return $this->_Nombre;
    }

    function set_Id($Id) {
        $this->_Id = $Id;
    }

    function set_Nombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    public function lista() {
        return $this->_db->select('SELECT * FROM Rol');
    }
    
    public function buscar($id){
         
        return $this->_db->select("SELECT * FROM Rol WHERE`Id` = {$id}");
 
        
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->get_Nombre()
        );

        $this->_db->insert('Rol', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->get_Nombre()
        );

        $donde = "`Id` = '{$this->get_Id()}'";

        $this->_db->update('Rol', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Rol', "`Id` = {$id}");
    }

}
