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

<form class="form-horizontal" method="post" id="FormPermiso" action="<?php echo ROOT; ?>permiso/_guardar/<?php echo $this->permiso->getId(); ?>" autocomplete="off">
    <h4>Permiso</h4>
    <hr />
    <input type="hidden" name="Id" value="<?php echo $this->permiso->getId(); ?>" readonly />

    <div class="form-group">
        <label for="Nombre" class="col-lg-3 control-label">Permiso</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre del Permiso" value="<?php echo $this->permiso->getNombre(); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="Descripcion" class="col-lg-3 control-label">Descripción</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" name="Descripcion" id="Descripcion" placeholder="Descripción" value="<?php echo $this->permiso->getDescripcion(); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>

</form>

<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>







