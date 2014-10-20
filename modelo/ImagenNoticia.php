<?php

class ImagenNoticia extends Modelo {

    private $_Id;
    private $_Titulo;
    private $_Descripcion;
    private $_Imagen;
    private $_NoticiaId;
    public $_ruta = 'public/img/noticia/';

    function __construct() {
        parent::__construct();
    }

    function getRuta() {
        return $this->_ruta;
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

    function getImagen() {
        return $this->_Imagen;
    }

    function getNoticiaId() {
        return $this->_NoticiaId;
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

    function setImagen($Imagen) {
        $this->_Imagen = $Imagen;
    }

    public function setNoticiaId($NoticiaId) {
        $this->_NoticiaId = $NoticiaId;
    }

//    private $_Id;
//    private $_Titulo;
//    private $_Descripcion;
//    private $_Ruta;
//    private $_NoticiaId;
    // ------------------- metodos de la bd ----------------------
    public function lista($where = '') {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM ImagenNoticia ' . $where);

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $imagenNoticia = new ImagenNoticia();

            $imagenNoticia->setId($temp['Id']);
            $imagenNoticia->setTitulo($temp['Titulo']);
            $imagenNoticia->setDescripcion($temp['Descripcion']);
            $imagenNoticia->setImagen($temp['Imagen']);
            $imagenNoticia->setNoticiaId($temp['NoticiaId']);

            $lista[] = $imagenNoticia;
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
        $temp = $this->_db->select("SELECT * FROM ImagenNoticia WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setTitulo($temp[0]['Titulo']);
            $this->setDescripcion($temp[0]['Descripcion']);
            $this->setImagen($temp[0]['Imagen']);
            $this->setNoticiaId($temp[0]['NoticiaId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Titulo' => $this->getTitulo(),
            'Descripcion' => $this->getDescripcion(),
            'Imagen' => $this->getImagen(),
            'NoticiaId' => $this->getNoticiaId()
        );

        return $this->_db->insert('ImagenNoticia', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Titulo' => $this->getTitulo(),
            'Descripcion' => $this->getDescripcion(),
            'Imagen' => $this->getImagen(),
            'NoticiaId' => $this->getNoticiaId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('ImagenNoticia', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('ImagenNoticia', "`Id` = {$id}");
    }

}
