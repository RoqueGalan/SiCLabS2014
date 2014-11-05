<?php

class DocumentoEspacio extends Modelo {

    private $_Id;
    private $_Documento;
    private $_TipoDocumento;
    private $_Espacio;
    public $_ruta = 'public/docx/espacio/';

    function __construct() {
        parent:: __construct();
        $this->_TipoDocumento = new TipoDocumento();
        $this->_Espacio = new Espacio();
    }

    function getRuta() {
        return $this->_ruta;
    }

    function getId() {
        return $this->_Id;
    }

    function getDocumento() {
        return $this->_Documento;
    }

    function getTipoDocumento() {
        return $this->_TipoDocumento;
    }

    function getEspacio() {
        return $this->_Espacio;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setDocumento($Documento) {
        $this->_Documento = $Documento;
    }

    function setTipoDocumento($TipoDocumento) {
        $this->_TipoDocumento = $TipoDocumento;
    }

    function setEspacio($Espacio) {
        $this->_Espacio = $Espacio;
    }

    public function lista($espacioId, $where = '') {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM DocumentoEspacio WHERE `EspacioId` = {$espacioId} {$where} ORDER BY `TipoDocumentoId` ASC");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $documento = new DocumentoEspacio();
            $documento->setId($temp['Id']);
            $documento->setDocumento($temp['Documento']);
            $documento->getTipoDocumento()->buscar($temp['TipoDocumentoId']);
            $documento->getEspacio()->buscar($temp['EspacioId']);

            $lista[] = $documento;
        }

        return $lista;
    }

    public function existe($espacioId, $tipoDocumentoId) {
        $temp = $this->_db->select("SELECT Id FROM DocumentoEspacio WHERE `EspacioId` = '{$espacioId}' AND `TipoDocumentoId` = '{$tipoDocumentoId}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM DocumentoEspacio WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setDocumento($temp[0]['Documento']);
            $this->getTipoDocumento()->buscar($temp[0]['TipoDocumentoId']);
            $this->getEspacio()->buscar($temp[0]['EspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Documento' => $this->getDocumento(),
            'TipoDocumentoId' => $this->getTipoDocumento()->getId(),
            'EspacioId' => $this->getEspacio()->getId()
        );

        return $this->_db->insert('DocumentoEspacio', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Documento' => $this->getDocumento(),
            'TipoDocumentoId' => $this->getTipoDocumento()->getId(),
            'EspacioId' => $this->getEspacio()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('DocumentoEspacio', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('DocumentoEspacio', "`Id` = {$id}");
    }

}
