</div>

<div id="footer">
</div>

</body>
<!-- Insertar aqui los scrips a utilizar -->
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>public/js/bootstrap.min.js"></script>

<?php
if (isset($this->js)) {
    foreach ($this->js as $ArchivoJS) {
        echo '<script type="text/javascript" src="' . ROOT . 'views/' . $ArchivoJS . '"></script>';
    }
}
?>
</html>