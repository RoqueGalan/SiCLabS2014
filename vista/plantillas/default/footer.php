<hr />
<footer>
    <p class="text-center">
        <b>Ingeniería en Computación</b>
        |
        Sistema de Control de Laboratorios y Salas de Cómputo
        |
        <b>2009-2014</b></p>
</footer>
</div>

<!-- Insertar aqui los scrips a utilizar -->
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/bootstrap.min.js"></script>

<?php
if (isset($this->javaScript)) {
    foreach ($this->javaScript as $javaScript) {
        echo '<script type="text/javascript" src="' . ROOT . 'views/' . $javaScript . '"></script>';
    }
}
?>

</body>
</html>