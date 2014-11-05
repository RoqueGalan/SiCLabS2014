<?php

class Ciclo extends Modelo {

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
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Ciclo ORDER BY `Nombre` ASC');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $ciclo = new Ciclo();
            $ciclo->setId($temp['Id']);
            $ciclo->setNombre($temp['Nombre']);

            $lista[] = $ciclo;
        }

        return $lista;
    }

    public function existe($nombre) {
        $temp = $this->_db->select("SELECT Id FROM Ciclo WHERE `Nombre` = '{$nombre}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Ciclo WHERE`Id` = {$id} LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
        } else {
            $this->setId(-1);
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre()
        );

        return $this->_db->insert('Ciclo', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Ciclo', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Ciclo', "`Id` = {$id}");
    }

}
