<!-- Mostrar Alerta de Errores al Evaluar el formulario -->
<?php if (isset($this->errorForm) && count($this->errorForm)): ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul>
            <?php
            foreach ($this->errorForm as $campoError) {
                foreach ($campoError as $error) {
                    echo '<li>' . $error . '</li>';
                }
            }
            ?>
        </ul>
    </div>
<?php endif; ?>

<form class="form-horizontal" id="FormTipoDocumento" method="post" action="<?php echo ROOT; ?>tipoDocumento/_guardar/<?php echo $this->tipoDocumento->getId(); ?>" autocomplete="off">
    <h4>Tipo de Documento</h4>
    <hr />
    <input type="hidden" name="Id" value="<?php echo $this->tipoDocumento->getId(); ?>" readonly />

    <div class="form-group ">
        <label for="Nombre" class="col-lg-3 control-label">Nombre</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del Tipo de Documento" value="<?php echo $this->tipoDocumento->getNombre(); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
    </div>

</form>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>







