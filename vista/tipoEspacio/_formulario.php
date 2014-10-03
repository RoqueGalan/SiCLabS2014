<!-- Mostrar Alerta de Errores al Evaluar el formulario -->
<?php if (isset($this->listaError)): ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul>
            <?php foreach ($this->listaError as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form class="form-horizontal" role="form" method="post" action="<?php echo ROOT; ?>tipoEspacio/_guardar/<?php echo $this->tipoEspacio->getId(); ?>">
    <h4>Tipo de Espacio</h4>
    <hr />
    <input type="hidden" name="Id" value="<?php echo $this->tipoEspacio->getId(); ?>" readonly />

    <div class="form-group ">
        <label for="Nombre" class="control-label col-md-2">Nombre</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del Tipo de Espacio" value="<?php echo $this->tipoEspacio->getNombre(); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
    </div>

</form>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>







