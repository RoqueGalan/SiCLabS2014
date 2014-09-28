<?php

class Rol extends Modelo {

    private $_Id;
    private $_Nombre;

    function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->_Id;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    public function lista() {

        $tempLista = $this->_db->select('SELECT * FROM Rol');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $rol = new Rol();
            $rol->setId($temp['Id']);
            $rol->setNombre($temp['Nombre']);

            $lista[] = $rol;
        }

        return $lista;
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Rol WHERE`Id` = {$id} LIMIT 1");

        $this->setId($temp[0]['Id']);
        $this->setNombre($temp[0]['Nombre']);

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre()
        );

        $this->_db->insert('Rol', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre()
        );

        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Rol', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Rol', "`Id` = {$id}");
    }

}
