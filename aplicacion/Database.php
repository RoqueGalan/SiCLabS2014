<?php

class Database extends PDO {

    public function __construct() {
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $opciones);


        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * select
     * @param string $consulta An SQL string
     * @param array $arreglo Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($consulta, $arreglo = array(), $fetchMode = PDO::FETCH_ASSOC) {

        $sth = $this->prepare($consulta);
        foreach ($arreglo as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }
    
     
    
  

    /**
     * insert
     * @param string $tabla A name of table to insert into
     * @param string $datos An associative array
     */
    public function insert($tabla, $datos = array()) {
        ksort($datos);

        $fieldNames = implode('`, `', array_keys($datos));
        $fieldValues = ':' . implode(', :', array_keys($datos));

        $sth = $this->prepare("INSERT INTO $tabla (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($datos as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    /**
     * update
     * @param string $tabla A name of table to insert into
     * @param string $datos An associative array
     * @param string $donde the WHERE query part
     */
    public function update($tabla, $datos, $donde) {
        ksort($datos);

        $fieldDetails = NULL;
        foreach ($datos as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $tabla SET $fieldDetails WHERE $donde");

        foreach ($datos as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    /**
     * delete
     * 
     * @param string $tabla
     * @param string $donde
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($tabla, $donde, $limit = 1) {
        return $this->exec("DELETE FROM $tabla WHERE $donde LIMIT $limit");
    }

}
