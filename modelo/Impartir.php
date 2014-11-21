<?php

class Impartir extends Modelo {

    private $_Id;
    private $_Curso;
    private $_Usuario;

    function __construct() {
        parent:: __construct();
        $this->_Curso = new Curso();
        $this->_Usuario = new Usuario();
    }

    function getId() {
        return $this->_Id;
    }

    function getCurso() {
        return $this->_Curso;
    }

    function getUsuario() {
        return $this->_Usuario;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setCurso($Curso) {
        $this->_Curso = $Curso;
    }

    function setUsuario($Usuario) {
        $this->_Usuario = $Usuario;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista($cursoId, $where = '') {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM Impartir WHERE `CursoId` = {$cursoId} {$where} ");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $impartir = new Impartir();
            $impartir->setId($temp['Id']);
            $impartir->getCurso()->buscar($temp['CursoId']);
            $impartir->getUsuario()->buscar($temp['UsuarioId']);

            $lista[] = $impartir;
        }

        return $lista;
    }

    public function existe($cursoId) {
        $temp = $this->_db->select("SELECT Id FROM `Impartir` WHERE CursoId = '{$cursoId}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Impartir WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->getCurso()->buscar($temp[0]['CursoId']);
            $this->getUsuario()->buscar($temp[0]['UsuarioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'CursoId' => $this->getCurso()->getId(),
            'UsuarioId' => $this->getUsuario()->getId()
        );

        return $this->_db->insert('Impartir', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'CursoId' => $this->getCurso()->getId(),
            'UsuarioId' => $this->getUsuario()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Impartir', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Impartir', "`Id` = {$id}");
    }

}
