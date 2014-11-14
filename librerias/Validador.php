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
     * Comparar campos
     * Compara que dos campos sean identicos
     * ERROR: 103
     */

    function compararCampos($campo1, $campo2, $insensibleMayusculasMinusculas = false) {
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
     * Comparar palabras
     * Compara que el campo sea igual a alguna palabra del arreglo
     * ERROR: 109
     */

    function compararPalabras($campo, $arreglo = array()) {
        $this->_existe($campo);

        if (!in_array($this->getValor($campo), $arreglo)) {
            $this->_setError($campo, 'No coincide la palabra', 109);
            return false;
        }

        return 1;
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
                    $this->_setError($campo, 'Longitud debe estar en el rango de Min ' . $min . ' y Max ' . $max, 104);
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
     * ERROR: 109
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

    /*
     * imagen
     * verifica que la imagen se suba
     * @param campo
     * @param ruta
     * ERROR: 110
     */

    /**
     * 
     * @param string $campo
     * @param string $ruta
     * @param string $requerido
     */
    function imagen($campo, $ruta, $requerido = false) {
        $imagen = 0;
        if ($_FILES[$campo]['name']) {
            $ruta = DIR_ROOT . $ruta;

            $upload = new upload($_FILES[$campo], 'es_Es');
            $upload->allowed = array('image/*');
            $upload->file_new_name_body = 'temp-' . uniqid();
            $upload->_mkdir($ruta);
            $upload->process($ruta);

            if ($upload->processed) {
                @unlink($upload->file_dst_pathname);
                $imagen = 1;
            } else {
                $this->_setError($campo, $upload->error, 110);
            }
        } else {
            if ($requerido && !$this->_lleno('ImagenDefault')) {
                $this->_setError($campo, 'Imagen Requerida', 110);
            }
        }
        return $imagen;
    }

    /*
     * archivo
     * verifica que la imagen se suba
     * @param campo
     * @param ruta
     * ERROR: 111
     */

    /**
     * 
     * @param string $campo nombre del Campo del formulario
     * @param string $ruta ruta donde se guardara el archivo
     * @param string $requerido si es requerido el archivo
     * 
     */
    function archivo($campo, $ruta, $requerido = false) {
        $archivo = 0;
        if ($_FILES[$campo]['name']) {
            $ruta = DIR_ROOT . $ruta;

            $upload = new upload($_FILES[$campo], 'es_Es');
            $upload->allowed = array('application/*');
            $upload->file_new_name_body = 'temp-' . uniqid();
            $upload->_mkdir($ruta);
            $upload->process($ruta);

            if ($upload->processed) {
                @unlink($upload->file_dst_pathname);
                $archivo = 1;
            } else {
                $this->_setError($campo, $upload->error, 111);
            }
        } else {
            if ($requerido && !$this->_lleno('DocumentoDefault')) {
                $this->_setError($campo, 'Archivo Requerido', 111);
            }
        }
        return $archivo;
    }

    /*
     * tiempo
     * verifica que sea tiempo
     * ERROR: 112
     */

    function tiempo($campo) {
        $this->_existe($campo);
        if ($this->_lleno($campo)) {
            $valor = $this->getValor($campo);
            if (!preg_match('/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])$/', $valor)) {
                $this->_setError($campo, 'Solo tiempo', 112);
            }
        }
    }

    /*
     * rango Tiempo
     * verifica que sea tiempo
     * ERROR: 113
     */

    function rangoTiempo($inicioHora, $finHora, $campo) {
        $this->_existe($campo);
        $t = new Tiempo();
        if (!$t->checarRango($inicioHora, $finHora, $this->getValor($campo))) {
            $this->_setError($campo, 'Tiempo fuera de rango', 113);
        }
    }

    /*
     * Tiempo primero menor
     * verifica que sea tiempo
     * ERROR: 114
     */

    function menorTiempo($campo1, $campo2) {
        $this->_existe($campo1);
        $this->_existe($campo2);
        if ($this->_lleno($campo1) && $this->_lleno($campo2)) {
            $t = new Tiempo();
            
            $tiempo1 = $t->horaEnSegundos($this->getValor($campo1));
            $tiempo2 = $t->horaEnSegundos($this->getValor($campo2));
            
            if($tiempo1 >= $tiempo2){
                $this->_setError($campo1, 'Tiempos desbalanceados', 114);
            }

        }
    }

}
