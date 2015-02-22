<?php

class Curso extends Modelo {

    private $_Id;
    private $_Asignatura;
    private $_Carrera;
    private $_Grupo;
    private $_Ciclo;
    private $_Descripcion;
    private $_Espacio;

    function __construct() {
        parent:: __construct();
        $this->_Asignatura = new Asignatura();
        $this->_Carrera = new Carrera();
        $this->_Grupo = new Grupo();
        $this->_Ciclo = new Ciclo();
        $this->_Espacio = new Espacio();
    }

    function getId() {
        return $this->_Id;
    }

    function getAsignatura() {
        return $this->_Asignatura;
    }

    function getCarrera() {
        return $this->_Carrera;
    }

    function getGrupo() {
        return $this->_Grupo;
    }

    function getCiclo() {
        return $this->_Ciclo;
    }

    function getDescripcion() {
        return $this->_Descripcion;
    }

    function getEspacio() {
        return $this->_Espacio;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setAsignatura($Asignatura) {
        $this->_Asignatura = $Asignatura;
    }

    function setCarrera($Carrera) {
        $this->_Carrera = $Carrera;
    }

    function setGrupo($Grupo) {
        $this->_Grupo = $Grupo;
    }

    function setCiclo($Ciclo) {
        $this->_Ciclo = $Ciclo;
    }

    function setDescripcion($Descripcion) {
        $this->_Descripcion = $Descripcion;
    }

    function setEspacio($Espacio) {
        $this->_Espacio = $Espacio;
    }

    
    public function lista($espacioId, $where = '') {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM Curso WHERE `EspacioId` = {$espacioId} {$where}");

        //crear una lista de objetos, para su facil extracion en las vistas

        foreach ($tempLista as $temp) {
            $curso = new Curso();
            $curso->setId($temp['Id']);
            $curso->getAsignatura()->buscar($temp['AsignaturaId']);
            $curso->getCarrera()->buscar($temp['CarreraId']);
            $curso->getGrupo()->buscar($temp['GrupoId']);
            $curso->getCiclo()->buscar($temp['CicloId']);
            $curso->setDescripcion($temp['Descripcion']);
            $curso->getEspacio()->buscar($temp['EspacioId']);

            $lista[] = $curso;
        }

        return $lista;
    }

    public function existe($asignatura, $carrera, $grupo, $ciclo, $espacio) {
        $temp = $this->_db->select("SELECT Id FROM Curso WHERE `AsignaturaId` = '{$asignatura}' AND `CarreraId` = '{$carrera}' AND `GrupoId` = '{$grupo}' AND `CicloId` = '{$ciclo}' AND `EspacioId` = '{$espacio}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Curso WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->getAsignatura()->buscar($temp[0]['AsignaturaId']);
            $this->getCarrera()->buscar($temp[0]['CarreraId']);
            $this->getGrupo()->buscar($temp[0]['GrupoId']);
            $this->getCiclo()->buscar($temp[0]['CicloId']);
            $this->setDescripcion($temp[0]['Descripcion']);
            $this->getEspacio()->buscar($temp[0]['EspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'AsignaturaId' => $this->getAsignatura()->getId(),
            'CarreraId' => $this->getCarrera()->getId(),
            'GrupoId' => $this->getGrupo()->getId(),
            'CicloId' => $this->getCiclo()->getId(),
            'Descripcion' => $this->getDescripcion(),
            'EspacioId' => $this->getEspacio()->getId()
        );

        return $this->_db->insert('Curso', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'AsignaturaId' => $this->getAsignatura()->getId(),
            'CarreraId' => $this->getCarrera()->getId(),
            'GrupoId' => $this->getGrupo()->getId(),
            'CicloId' => $this->getCiclo()->getId(),
            'Descripcion' => $this->getDescripcion(),
            'EspacioId' => $this->getEspacio()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Curso', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Curso', "`Id` = {$id}");
    }

}
