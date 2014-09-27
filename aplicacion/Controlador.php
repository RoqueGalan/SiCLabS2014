<?php

class Controlador {

    function __construct() {

        $this->vista = new Vista();
    }

    /**
     * 
     * @param string $nombre Nombre del Modelo
     */
    public function cargarModelo($nombre) {

        $ruta = ROOT . "modelo/" . $nombre . '.php';

        if (file_exists($ruta)) {

            require $ruta;

            $nombreModelo = $nombre;
            $this->modelo = new $nombreModelo();
        }
    }

    /*
      protected function getTexto($datos) {
      if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
      $_POST[$datos] = htmlspecialchars($_POST[$datos], ENT_QUOTES);
      return $_POST[$datos];
      }

      return '';
      }

      protected function getEntero($datos) {
      if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
      $_POST[$datos] = filter_input(INPUT_POST, $datos, FILTER_VALIDATE_INT);
      return $_POST[$datos];
      }

      return 0;
      }

      protected function redireccionar($ruta = false) {
      if ($ruta) {
      header('location:' . ROOT . $ruta);
      exit;
      } else {
      header('location:' . ROOT);
      exit;
      }
      }

      protected function filtrarEntero($entero) {
      $entero = (int) $entero;

      if (is_int($entero)) {
      return $entero;
      } else {
      return 0;
      }
      }

      protected function getPostParametro($datos) {
      if (isset($_POST[$datos])) {
      return $_POST[$datos];
      }
      }

      protected function getSql($datos) {
      if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
      $_POST[$datos] = strip_tags($_POST[$datos]);

      if (!get_magic_quotes_gpc()) {
      $_POST[$datos] = mysql_real_escape_string($_POST[$datos], mysql_connect(DB_HOST, DB_USER, DB_PASS));
      }

      return trim($_POST[$datos]);
      }
      }

      protected function getString($datos) {
      if (isset($_POST[$datos]) && !empty($_POST[$datos])) {
      $_POST[$datos] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$datos]);
      return trim($_POST[$datos]);
      }
      }

      public function validarEmail($email) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
      }

      return true;
      }

     */
}
