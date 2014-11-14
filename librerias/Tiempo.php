<?php

class Tiempo {

    public function __construct() {
        
    }

    function horaEnSegundos($hora) {
        return strtotime($hora);
    }

    private function _segundosAHora($segundos) {
        return date("H:i", $segundos);
    }

    public function stringAHora($cadena) {
        $segundos = $this->horaEnSegundos($cadena);
        $hora = $this->_segundosAHora($segundos);

        return $hora;
    }

    public function set_SQLHora($cadena) {
        $segundos = $this->horaEnSegundos($cadena);
        $hora = date("H:i:s", $segundos);
        ;

        return $hora;
    }

    public function sumaResta($horaInicial, $minutoAnadir, $operador = '+') {
        $segundos_horaInicial = strtotime($horaInicial);
        $segundos_minutoAnadir = $minutoAnadir * 60;
        switch ($operador) {
            case '+':
                $nuevaHora = date("H:i", $segundos_horaInicial + $segundos_minutoAnadir);
                break;
            case '-':
                $nuevaHora = date("H:i", $segundos_horaInicial - $segundos_minutoAnadir);
                break;

            default:
                $nuevaHora = date("H:i", $segundos_horaInicial);
                break;
        }
        return $nuevaHora;
    }

    /*
     * horarios:
     * lista de horarios
     * dia , inicio, fin 
     */

    public function comprobarHorarioCurso($horaInicial, $horaFinal) {
        //todo en segundos
        $limiteMin = $this->horaEnSegundos('07:00'); //00
        $limiteMax = $this->horaEnSegundos('21:00'); //100
        
        $Inicial = $this->horaEnSegundos($horaInicial); //00
        $Final = $this->horaEnSegundos($horaFinal); //20

        $disponible = false;

        //00>=00 y 20<=100
        if ($Inicial >= $limiteMin && $Final <= $limiteMax) {
            // entrando al if esta disponible
            $disponible = true;

            //horarios ocupados
            //20-30
            //30-50
            //comprobar si esta disponible
          
        }
    }

//    function cadenaRango($campo, $min, $max, $incluirExtremos = false) {
//        if ($this->_lleno($campo)) {
//            $longitudReal = strlen(trim($this->getValor($campo)));
//            if (!$incluirExtremos) {
//                // 5 < max  y 5 > min
//                if (!($longitudReal < $max && $longitudReal > $min)) {
//                    $this->_setError($campo, 'Longitud debe estar en el rango de Min ' . $min . ' y Max ' . $max, 104);
//                }
//            } else {
//                if (!($longitudReal <= $max && $longitudReal >= $min)) {
//                    $this->_setError($campo, 'Longitud debe estar en el rango de Min ' . $min . ' y Max ' . $max, 104);
//                }
//            }
//        }
//    }

//    function check_in_range($start_date, $end_date, $evaluame) {
//        $start_ts = strtotime($start_date);
//        $end_ts = strtotime($end_date);
//        $user_ts = strtotime($evaluame);
//        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
//    }
//    
    
    function checarRango($inicioHora, $finHora, $hora) {
        $start_ts = strtotime($inicioHora);
        $end_ts = strtotime($finHora);
        $user_ts = strtotime($hora);
        
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

}
