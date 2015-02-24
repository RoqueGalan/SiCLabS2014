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
        return date("H:i", strtotime($this->_Inicio));
    }

    function getFin() {
        return date("H:i", strtotime($this->_Fin));
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
        $tempLista = $this->_db->select("SELECT * FROM HorarioCurso WHERE `CursoId` = {$cursoId} {$where} ORDER BY `Dia`, `Inicio`");

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

    public function existe($dia, $inicio, $fin, $cursoId) {

        $c = new Curso();
        $h = new HorarioCurso();

        $c->buscar($cursoId);
        $listaTemp = $h->_db->select("SELECT * FROM `HorarioCurso` AS `h`, `Curso` AS `c` WHERE "
                . "c.EspacioId = '{$c->getEspacio()->getId()}' AND "
                . "c.CicloId = '{$c->getCiclo()->getId()}' AND "
                . "h.Dia = '{$dia}'");
        if (count($listaTemp)) {
            foreach ($listaTemp as $horario) {
                //rango definido por el usuario desde el form
                $rango1_inicio = strtotime($inicio);
                $rango1_fin = strtotime($fin);
                //rango definido por la base de datos
                $rango2_inicio = strtotime($horario['Inicio']);
                $rango2_fin = strtotime($horario['Fin']);
                //comparaciones
                ($rango1_inicio == $rango2_inicio) || ($rango1_inicio > $rango2_inicio ? $rango1_inicio < $rango2_fin : $rango2_inicio < $rango1_fin) ?
                                $existe = true :
                                $existe = false;
            }
        }else{
            $existe = false;
        }
        return $existe;
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
