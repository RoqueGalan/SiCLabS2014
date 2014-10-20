<?php

class Noticia extends Modelo {

    private $_Id;
    private $_Titulo;
    private $_Descripcion;
    private $_Fecha;
    private $_Espacio;
    
    function __construct() {
        parent:: __construct();
        $this->_Espacio = new Espacio();
    }
        
    function getId() {
        return $this->_Id;
    }

    function getTitulo() {
        return $this->_Titulo;
    }

    function getDescripcion() {
        return $this->_Descripcion;
    }

    function getFecha() {
        return $this->_Fecha;
    }

    function getEspacio() {
        return $this->_Espacio;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setTitulo($Titulo) {
        $this->_Titulo = $Titulo;
    }

    function setDescripcion($Descripcion) {
        $this->_Descripcion = $Descripcion;
    }

    function setFecha($Fecha) {
        $this->_Fecha = $Fecha;
    }

    function setEspacio($Espacio) {
        $this->_Espacio = $Espacio;
    }

    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Noticia ORDER BY `Fecha` ASC');

        //crear una lista de objetos, para su facil extracion en las vistas

        foreach ($tempLista as $temp) {
            $noticia = new Noticia();
            $noticia->setId($temp['Id']);
            $noticia->setTitulo($temp['Titulo']);
            $noticia->setDescripcion($temp['Descripcion']);
            $noticia->setFecha($temp['Fecha']);
            $noticia->getEspacio()->buscar($temp['EspacioId']);

            $lista[] = $noticia;
        }

        return $lista;
    }

    //    public function existe($titulo) {
//        $temp = $this->_db->select("SELECT Id FROM Noticia WHERE `Titulo` = '{$titulo}' LIMIT 1");
//
//        if (count($temp)) {
//            //existe verdadero
//            return $temp[0]['Id'];
//        } else {
//            return 0;
//        }
//    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Noticia WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setTitulo($temp[0]['Titulo']);
            $this->setDescripcion($temp[0]['Descripcion']);
            $this->setFecha($temp[0]['Fecha']);
            $this->getEspacio()->buscar($temp[0]['EspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }


    public function insertar() {
        $parametros = array(
            'Titulo' => $this->getTitulo(),
            'Descripcion' => $this->getDescripcion(),
            'EspacioId' => $this->getEspacio()->getId()
        );

        return $this->_db->insert('Noticia', $parametros);
    }
    
    public function actualizar() {
        $parametros = array(
            'Titulo' => $this->getTitulo(),
            'Descripcion' => $this->getDescripcion(),
            'EspacioId' => $this->getEspacio()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Noticia', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('noticia', "`Id` = {$id}");
    }


}
