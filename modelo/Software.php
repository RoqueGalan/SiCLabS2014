<?php

class Software extends Modelo{
    private $_Id;
    private $_Nombre;
    private $_Descripcion;
    private $_Oculto;
    private $_Espacio;
    
    function __construct() {
        parent:: __construct();
        $this->_Espacio = new Espacio();
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

    function getOculto() {
        return $this->_Oculto;
    }

    function getEspacio() {
        return $this->_Espacio;
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

    function setOculto($Oculto) {
        $this->_Oculto = $Oculto;
    }

    function setEspacio($Espacio) {
        $this->_Espacio = $Espacio;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista($espacioId, $where = '') {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM Software WHERE `EspacioId` = {$espacioId} {$where} ORDER BY `Nombre` ASC");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $software = new Software();
            $software->setId($temp['Id']);
            $software->setNombre($temp['Nombre']);
            $software->setDescripcion($temp['Descripcion']);
            $software->setOculto($temp['Oculto']);
            $software->getEspacio()->buscar($temp['EspacioId']);

            $lista[] = $software;
        }

        return $lista;
    }
    
    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Software WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setDescripcion($temp[0]['Descripcion']);
            $this->setOculto($temp[0]['Oculto']);
            $this->getEspacio()->buscar($temp[0]['EspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }
    
    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion(),
            'Oculto' => $this->getOculto(),
            'EspacioId' => $this->getEspacio()->getId()
        );

        return $this->_db->insert('Software', $parametros);
    }
    
    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion(),
            'Oculto' => $this->getOculto(),
            'EspacioId' => $this->getEspacio()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Software', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Software', "`Id` = {$id}");
    }

}
