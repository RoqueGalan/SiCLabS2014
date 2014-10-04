<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Errores
 * Clave    Metodo          Texto
 * --------------------------------------------------------
 * 100      requerido       Requerido
 * 100      _lleno          Esta vacio
 * 101      cadenaLongitud  Longitud tiene que ser
 * 102      email           Correo no valido
 * 103      comparar        No coincide
 * 104      cadenaRango     Longitud debe estar en el rango de Min y Max
 * 105      numerico        No es numerico  
 * 106      numeroLongitud  Valor tiene que ser
 * 107      numeroRango     Valor debe estar en el rango
 * 108      letras          Solo letras
 * 109      alfanumerico    Solo caracteres alphanumericos
 * 
 */

/**
 * Description of Validador
 *
 * @author Roque Galán
 */
class Validador {

    private $_request = array();
    private $_error = array();

    function Validador($requestArray) {
        $this->_request = $requestArray;
    }

    function getValor($campo) {
        $this->_existe($campo); // el campo debe de existir
        return $this->_request[$campo];
    }

    function getErrorLista() {
        return $this->_error;
    }

    private function _setValor($campo, $valor) {
        $this->_request[$campo] = $valor;
    }

    private function _setError($campo, $texto, $error) {
        $this->_error[$campo][$error] = $campo . ': ' . $texto;
    }

    private function getError($campo, $error) {
        return $this->_error[$campo][$error];
    }

    /*
     * Verifica que el campo exista
     */

    private function _existe($campo) {
        if (!array_key_exists($campo, $this->_request)) {
            header('location:' . ROOT . 'error/tipo/Formulario_NoExisteCampo');
            exit;
        }
    }

    /*
     * Verifica que el campo no este vacio
     */

    private function _lleno($campo) {
        if (empty($this->getValor($campo))) {
            return 0;
        }
        return 1;
    }

    /*
     * Filtrar campo de SQL
     */

    private function _filtrarSQL($campo) {
        if ($this->_lleno($campo)) {
            $this->_request[$campo] = strip_tags($this->getValor($campo));
            if (!get_magic_quotes_gpc()) {
                $this->_request[$campo] = mysql_real_escape_string($this->getValor($campo), mysql_connect(DB_HOST, DB_USER, DB_PASS));
            }
            trim($this->_request[$campo]);
        }
    }

    /*
     * Requerido
     * Campo requerido
     * Campo NO => null, vacio, 0, 0.0, false
     * ERROR: 100
     */

    function requerido($campo) {
        if (!$this->_lleno($campo)) {
            $this->_setError($campo, 'Requerido', 100);
        }
    }

    /*
     * Longitud
     * checa que la longitud del campo sea la indicada
     * operador.  "<", ">", "<=", ">=", "="
     * ERROR: 101
     */

    function cadenaLongitud($campo, $operador, $longitud) {
        if ($this->_lleno($campo)) {
            $longitudReal = strlen(trim($this->getValor($campo)));
            switch ($operador) {
                case "<":
                    // campo menor a longitud
                    if (!($longitudReal < $longitud) && ($longitudReal > 0)) {
                        $this->_setError($campo, 'Longitud tiene que ser menor a ' . $longitud, 101);
                    }
                    break;
                case ">":
                    // campo mayor a longitud
                    if (!($longitudReal > $longitud)) {
                        $this->_setError($campo, 'Longitud tiene que ser mayor a ' . $longitud, 101);
                    }
                    break;
                case "=":
                    // campo igual a longitud
                    if (!($longitudReal == $longitud)) {
                        $this->_setError($campo, 'Longitud tiene que ser igual a ' . $longitud, 101);
                    }
                    break;
                case "<=":
                    // campo menor a longitud
                    if (!($longitudReal <= $longitud) && ($longitudReal > 0)) {
                        $this->_setError($campo, 'Longitud tiene que ser menor o igual a ' . $longitud, 101);
                    }
                    break;
                case ">=":
                    // campo mayor a longitud
                    if (!($longitudReal >= $longitud)) {
                        $this->_setError($campo, 'Longitud tiene que ser mayor o igual a ' . $longitud, 101);
                    }
                    break;
                default:
                    header('location:' . ROOT . 'error/tipo/Formulario_NoExisteOperador');
                    exit;
                    break;
            }
        }
    }

    /*
     * Correo Electronico
     * valida la sintaxis del correo
     * ERROR: 102
     */

    public function email($campo) {
        $this->_existe($campo);
        if (!filter_var($this->getValor($campo), FILTER_VALIDATE_EMAIL)) {
            $this->_setError($campo, 'Correo no valido', 102);
        }
    }

    /*
     * Comparar
     * Compara que dos campos sean identicos
     * ERROR: 103
     */

    function comparar($campo1, $campo2, $insensibleMayusculasMinusculas = false) {
        $this->_existe($campo1);
        $this->_existe($campo2);
        if ($this->_lleno($campo1) && $this->_lleno($campo2)) {
            if ($insensibleMayusculasMinusculas) {
                if (strcmp(strtolower($this->getValor($campo1)), strtolower($this->getValor($campo1))) != 0) {
                    $this->_setError($campo1, 'No coincide', 103);
                    $this->_setError($campo2, 'No coincide', 103);
                }
            } else {
                if (strcmp($this->getValor($campo1), $this->getValor($campo2)) != 0) {
                    $this->_setError($campo1, 'No coincide', 103);
                    $this->_setError($campo2, 'No coincide', 103);
                }
            }
        }
    }

    /*
     * Cadena Rango
     * Compara la longitd en un rango min y max 
     * ERROR: 104
     */

    function cadenaRango($campo, $min, $max, $incluirExtremos = false) {
        if ($this->_lleno($campo)) {
            $longitudReal = strlen(trim($this->getValor($campo)));
            if (!$incluirExtremos) {
                // 5 < max  y 5 > min
                if (!($longitudReal < $max && $longitudReal > $min)) {
                    $this->_setError($campo, 'Longitud debe estar en el rango de Min ' . $min . ' y Max ' . $max, 104);
                }
            } else {
                if (!($longitudReal <= $max && $longitudReal >= $min)) {
                    $this->_setError($campo, 'Longitud debe estar en el rando de Min ' . $min . ' y Max ' . $max, 104);
                }
            }
        }
    }

    /* convierte a numero el campo
     * ERROR 105
     */

    function numerico($campo, $tipoDato = 'int') {
        $valor = $this->getValor($campo);
        if (is_numeric($valor)) {
            switch ($tipoDato) {
                case 'int':
                    $valor = intval($valor);
                    break;
                case 'double':
                    $valor = doubleval($valor);
                    break;
                case 'float':
                    $valor = floatval($valor);
                    break;
                case 'bool':
                    $valor = boolval($valor);
                    break;
                default:
                    $valor = intval($valor);
                    break;
            }
            $this->_setValor($campo, $valor);
            return $valor;
        } else {
            $this->_setError($campo, 'No es numerico', 105);
            return false;
        }
    }

    /*
     * Numero longitud
     * Compara el valor dependiendo el operador  "<", ">", "<=", ">=", "="
     * ERROR: 106
     */

    function numeroLongitud($campo, $operador, $limite, $tipoDato = 'int') {
        $this->_existe($campo);
        if ($this->_lleno($campo) && $this->numerico($campo, $tipoDato)) {
            $valorReal = $this->getValor($campo);
            switch ($operador) {
                case "<":
                    // campo menor a limite
                    if (!($valorReal < $limite)) {
                        $this->_setError($campo, 'Valor tiene que ser menor a ' . $limite, 106);
                    }
                    break;
                case ">":
                    // campo mayor a limite
                    if (!($valorReal > $limite)) {
                        $this->_setError($campo, 'Valor tiene que ser mayor a ' . $limite, 106);
                    }
                    break;
                case "=":
                    // campo igual a limite
                    if (!($valorReal == $limite)) {
                        $this->_setError($campo, 'Valor tiene que ser igual a ' . $limite, 106);
                    }
                    break;
                case "<=":
                    // campo menor igual a limite
                    if (!($valorReal <= $limite)) {
                        $this->_setError($campo, 'Valor tiene que ser menor o igual a ' . $limite, 106);
                    }
                    break;
                case ">=":
                    // campo mayor igual a limite
                    if (!($valorReal >= $limite)) {
                        $this->_setError($campo, 'Valor tiene que ser mayor o igual a ' . $limite, 106);
                    }
                    break;
                default:
                    header('location:' . ROOT . 'error/tipo/Formulario_NoExisteOperador');
                    exit;
                    break;
            }
        }
    }

    /*
     * Numero Rango
     * Compara el valor en un rango min y max 
     * ERROR: 107
     */

    function numeroRango($campo, $min, $max, $tipoDato = 'int', $incluirExtremos = false) {
        $this->_existe($campo);
        if ($this->_lleno($campo) && $this->numerico($campo, $tipoDato)) {
            $valorReal = $this->getValor($campo);
            if (!$incluirExtremos) {
                // 5 < max  y 5 > min
                if ($valorReal > $max && $valorReal < $min) {
                    $this->_setError($campo, 'Valor debe estar en el rango de min ' . $min . ' y Max ' . $max, 107);
                }
            } else {
                if ($valorReal >= $max && $valorReal <= $min) {
                    $this->_setError($campo, 'Valor debe estar en el rango de min ' . $min . ' y Max ' . $max, 107);
                }
            }
        }
    }

    /*
     * Solo Letras
     * verifica que solo sean letras
     * ERROR: 108
     */

    function letras($campo) {
        $this->_existe($campo);
        if ($this->_lleno($campo)) {
            $valor = $this->getValor($campo);
            if (!preg_match("/^([A-Za-zÑñáéíóúÁÉÍÓÚ ]+)$/", $valor)) {
                $this->_setError($campo, 'Solo letras', 108);
            }
        }
    }

    /*
     * alfanumerico
     * verifica que solo sean letras y numeros
     * ERROR: 108
     */

    function alfanumerico($campo) {
        $this->_existe($campo);
        if ($this->_lleno($campo)) {
            $valor = utf8_encode($this->getValor($campo));
            if (!preg_match("/^([A-Za-zÑñáéíóúÁÉÍÓÚ0123456789 ]+)$/", $valor)) {
                $this->_setError($campo, 'Solo caracteres alphanumericos', 109);
            }
        }
    }

}
