<?php

class DocumentoEspacio extends Modelo {

    private $_Id;
    private $_Nombre;
    private $_Documento;
    private $_TipoDocumento;
    private $_EspacioId;
    public $_ruta = 'public/docx/Espacio';

    function __construct() {
        parent::__construct();
        $this->_TipoDocumento = new TipoDocumento();
    }
    
    function getId() {
        return $this->_Id;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function getDocumento() {
        return $this->_Documento;
    }

    function getTipoDocumento() {
        return $this->_TipoDocumento;
    }

    function getEspacioId() {
        return $this->_EspacioId;
    }

    function getRuta() {
        return $this->_ruta;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    function setDocumento($Documento) {
        $this->_Documento = $Documento;
    }

    function setTipoDocumento($TipoDocumento) {
        $this->_TipoDocumento = $TipoDocumento;
    }

    function setEspacioId($EspacioId) {
        $this->_EspacioId = $EspacioId;
    }
    
//    private $_Id;
//    private $_Nombre;
//    private $_Documento;
//    private $_TipoDocumento;
//    private $_EspacioId;
    // ------------------- metodos de la bd ----------------------
    public function lista($EspacioId) {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM DocumentoEspacio WHERE `EspacioId` = {$EspacioId} ORDER BY `TipoDocumentoId`");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $documentoEspacio = new DocumentoEspacio();

            $documentoEspacio->setId($temp['Id']);
            $documentoEspacio->setNombre($temp['Nombre']);
            $documentoEspacio->setDocumento($temp['Documento']);
            $documentoEspacio->getTipoDocumento()->buscar($temp['TipoDocumentoId']);
            $documentoEspacio->setEspacioId($temp['EspacioId']);

            $lista[] = $documentoEspacio;
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
        $temp = $this->_db->select("SELECT * FROM DocumentoEspacio WHERE `Id` = '{$id}' LIMIT 1");
        
        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setDocumento($temp[0]['Documento']);
            $this->getTipoDocumento()->buscar($temp[0]['TipoDocumentoId']);
            $this->setEspacioId($temp[0]['EspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Documento' => $this->getDocumento(),
            'TipoDocumentoId' => $this->getTipoDocumento()->getId(),
            'EspacioId' => $this->getEspacioId()
        );

        return $this->_db->insert('DocumentoEspacio', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Documento' => $this->getDocumento(),
            'TipoDocumentoId' => $this->getTipoDocumento()->getId(),
            'EspacioId' => $this->getEspacioId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('DocumentoEspacio', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('DocumentoEspacio', "`Id` = {$id}");
    }

}
