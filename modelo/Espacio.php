<?php

class Espacio extends Modelo {

    private $_Id;
    private $_Nombre;
    private $_Descripcion;
    private $_TipoEspacio;

    function __construct() {
        parent::__construct();
        $this->_TipoEspacio = new TipoEspacio();
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

    function getTipoEspacio() {
        return $this->_TipoEspacio;
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

    function setTipoEspacio($TipoEspacio) {
        $this->_TipoEspacio = $TipoEspacio;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Espacio ');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $espacio = new Espacio();
            
            $espacio->setId($temp['Id']);
            $espacio->setNombre($temp['Nombre']);
            $espacio->setDescripcion($temp['Descripcion']);
            $espacio->getTipoEspacio()->buscar($temp['TipoEspacioId']);

            $lista[] = $espacio;
        }

        return $lista;
    }

//    public function existe($nombre) {
//        $temp = $this->_db->select("SELECT Id FROM Espacio WHERE `Nombre` = '{$nombre}' LIMIT 1");
//
//        if (count($temp)) {
//            //existe verdadero
//            return $temp[0]['Id'];
//        } else {
//            return 0;
//        }
//    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Espacio WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setDescripcion($temp[0]['Descripcion']);
            $this->getTipoEspacio()->buscar($temp[0]['TipoEspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion(),
            'TipoEspacioId' => $this->getTipoEspacio()->getId()
        );

        return $this->_db->insert('Espacio', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion(),
            'TipoEspacioId' => $this->getTipoEspacio()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Espacio', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Espacio', "`Id` = {$id}");
    }

}
