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


<form class="form-horizontal" id="FormRol" method="post" action="<?php echo ROOT; ?>rol/_guardar/<?php echo $this->rol->getId(); ?>">
    <h4>Rol</h4>
    <hr />
    <input type="hidden" name="Id" value="<?php echo $this->rol->getId(); ?>" readonly />

    <div class="form-group">
        <label for="Nombre" class="col-lg-3 control-label">Rol</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre del Rol" value="<?php echo $this->rol->getNombre(); ?>" autocomplete="off"/>
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







