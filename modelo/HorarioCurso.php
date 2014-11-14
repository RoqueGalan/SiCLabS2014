<?php

class HorarioCurso extends Modelo {

    private $_Id;
    private $_Dia;
    private $_Inicio;
    private $_Fin;
    private $_Curso;

    function __construct() {
        parent:: __construct();
        $this->_Curso = new Curso();
    }

    function getId() {
        return $this->_Id;
    }

    function getDia() {
        return $this->_Dia;
    }

    function getInicio() {
        return date("H:i",strtotime($this->_Inicio));
    }

    function getFin() {
        return date("H:i",strtotime($this->_Fin));
    }

    function getCurso() {
        return $this->_Curso;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setDia($Dia) {
        $this->_Dia = $Dia;
    }

    function setInicio($Inicio) {
        $this->_Inicio = $Inicio;
    }

    function setFin($Fin) {
        $this->_Fin = $Fin;
    }

    function setCurso($Curso) {
        $this->_Curso = $Curso;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista($cursoId, $where = '') {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM HorarioCurso WHERE `CursoId` = {$cursoId} {$where} ORDER BY 'Dia' DESC, 'Inicio' DESC");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $horario = new HorarioCurso();
            $horario->setId($temp['Id']);
            $horario->setDia($temp['Dia']);
            $horario->setInicio($temp['Inicio']);
            $horario->setFin($temp['Fin']);
            $horario->getCurso()->buscar($temp['CursoId']);

            $lista[] = $horario;
        }

        return $lista;
    }
    
    public function existe($inicio, $fin, $dia, $EspacioId) {
        $temp = $this->_db->select("SELECT * FROM `HorarioCurso` AS `h`, `Curso` AS `c` WHERE c.EspacioId = '{$EspacioId}' AND h.Dia = '{$dia}' AND(`Inicio` >= '{$inicio}' AND `Fin` <= '{$fin}' ) LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }
    
    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM HorarioCurso WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setDia($temp[0]['Dia']);
            $this->setInicio($temp[0]['Inicio']);
            $this->setFin($temp[0]['Fin']);
            $this->getCurso()->buscar($temp[0]['CursoId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Dia' => $this->getDia(),
            'Inicio' => $this->getInicio(),
            'Fin' => $this->getFin(),
            'CursoId' => $this->getCurso()->getId()
        );

        return $this->_db->insert('HorarioCurso', $parametros);
    }
    
    public function actualizar() {
        $parametros = array(
            'Dia' => $this->getDia(),
            'Inicio' => $this->getInicio(),
            'Fin' => $this->getFin(),
            'CursoId' => $this->getCurso()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('HorarioCurso', $parametros, $donde);
    }
    
    public function eliminar($id) {
        $this->_db->delete('HorarioCurso', "`Id` = {$id}");
    }
}
