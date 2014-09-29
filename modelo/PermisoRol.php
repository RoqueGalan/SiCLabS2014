<?php

class PermisoRol extends Modelo {

    private $_Id;
    private $_Permiso;
    private $_Rol;
    private $_Estado;

    function __construct() {
        parent::__construct();
        $this->_Rol = new Rol();
        $this->_Permiso = new Permiso();
    }

    function getId() {
        return $this->_Id;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function getPermiso() {
        return $this->_Permiso;
    }

    function getRol() {
        return $this->_Rol;
    }

    function getEstado() {
        return $this->_Estado;
    }

    function setPermiso($Permiso) {
        $this->_Permiso = $Permiso;
    }

    function setRol($Rol) {
        $this->_Rol = $Rol;
    }

    function setEstado($Estado) {
        $this->_Estado = $Estado;
    }

    public function lista() {
        $lista = array();

        $tempLista = $this->_db->select("SELECT * FROM PermisoRol WHERE `RolId` = {$this->_Rol->getId()}");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $permiso = new Permiso();
            $permisoRol = new PermisoRol();
            $permisoRol->setId($temp['Id']);
            $permisoRol->setRol($this->_Rol);
            $permisoRol->setPermiso($permiso->buscar($temp['PermisoId']));
            $permisoRol->setEstado($temp['Estado']);
            $lista[] = $permisoRol;
        }

        return $lista;
    }

    public function buscar($Id) {
        $temp = $this->_db->select("SELECT * FROM PermisoRol WHERE `Id` = {$Id} LIMIT 1");

        $rol = new Rol();
        $permiso = new Permiso();



        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setRol($rol->buscar($temp[0]['RolId']));
            $this->setPermiso($permiso->buscar($temp[0]['PermisoId']));

            $this->setEstado($temp[0]['Estado']);
        } else {
            //no existe
            $this->setId(-1);
        }

        return $this;
    }

    public function existe($rolId, $permisoId) {
        $temp = $this->_db->select("SELECT * FROM PermisoRol WHERE `RolId` = {$rolId} AND `PermisoId` = {$permisoId} LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return true;
        } else {
            return false;
        }
    }

    public function insertar() {
        $parametros = array(
            'RolId' => $this->getRol()->getId(),
            'PermisoId' => $this->getPermiso()->getId(),
            'Estado' => $this->getEstado()
        );

        $this->_db->insert('PermisoRol', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'RolId' => $this->getRol()->getId(),
            'PermisoId' => $this->getPermiso()->getId(),
            'Estado' => $this->getEstado()
        );
        
  
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('PermisoRol', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('PermisoRol', "`Id` = {$id}");
    }

}
