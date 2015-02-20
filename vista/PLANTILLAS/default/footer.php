

<hr />
<footer>
    <p class="text-center">
        <b>Ingeniería en Computación</b>
        |
        Sistema de Control de Laboratorios y Salas de Cómputo
        |
        <b>2009-2015</b></p>
</footer>
</div>

<!-- Insertar aqui los scrips a utilizar en la plantilla-->
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/global.js"></script>

<!-- Insertar aqui los scrips a utilizar en el controlador-->
<?php
if (count($this->_js)) {
    foreach ($this->_js as $js) {
        echo '<script type="text/javascript" src="' . $js . '"></script>';
    }
}
?>

</body>
</html>