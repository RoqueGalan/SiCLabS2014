<?php

class Permiso extends Modelo {

    private $_Id;
    private $_Nombre;
    private $_Descripcion;

    function __construct() {
        parent:: __construct();
    }

    function getId() {
        return $this->_Id;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function getDescripcion() {
        return $this->_Descripcion;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    function setDescripcion($Descripcion) {
        $this->_Descripcion = $Descripcion;
    }

    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Permiso ORDER BY `Nombre` ASC');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $permiso = new Permiso();
            $permiso->setId($temp['Id']);
            $permiso->setNombre($temp['Nombre']);
            $permiso->setDescripcion($temp['Descripcion']);

            $lista[] = $permiso;
        }

        return $lista;
    }

    public function existe($nombre) {
        $temp = $this->_db->select("SELECT Id FROM Permiso WHERE `Nombre` = '{$nombre}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }
    
    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Permiso WHERE`Id` = {$id} LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setDescripcion($temp[0]['Descripcion']);
        } else {
            $this->setId(-1);
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion()
        );

        $this->_db->insert('Permiso', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion()
        );

        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Permiso', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Permiso', "`Id` = {$id}");
    }

}
