<?php

class Uda extends Modelo {

    private $_Id;
    private $_Nombre;
    private $_Carrera;

    function __construct() {
        parent:: __construct();
        $this->_Carrera = new Carrera();
    }

    function getId() {
        return $this->_Id;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function getCarrera() {
        return $this->_Carrera;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    function setCarrera($Carrera) {
        $this->_Carrera = $Carrera;
    }

    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM Uda ORDER BY `Nombre` ASC");

        //crear una lista de objetos, para su facil extracion en las vistas

        foreach ($tempLista as $temp) {
            $uda = new Uda();
            $uda->setId($temp['Id']);
            $uda->setNombre($temp['Nombre']);
            $uda->getCarrera()->buscar($temp['CarreraId']);

            $lista[] = $uda;
        }

        return $lista;
    }

    public function existe($nombre, $carreraId) {
        $temp = $this->_db->select("SELECT Id FROM Uda WHERE `Nombre` = '{$nombre}' AND `CarreraId` = '{$carreraId}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Uda WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->getCarrera()->buscar($temp[0]['CarreraId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }
    
    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'CarreraId' => $this->getCarrera()->getId()
        );

        return $this->_db->insert('Uda', $parametros);
    }
    
    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'CarreraId' => $this->getCarrera()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Uda', $parametros, $donde);
    }
    
    public function eliminar($id) {
        $this->_db->delete('Uda', "`Id` = {$id}");
    }

}
