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

<form class="form" role="form" method="post" action="<?php echo ROOT; ?>rol/_guardar/<?php echo $this->rol->getId(); ?>">

    <input type="hidden" name="Id" value="<?php echo $this->rol->getId(); ?>" readonly />


    <div class="form-group">
        <label for="Nombre">Rol</label>
        <input type="text" class="form-control" id="Nombre" name="Nombre"placeholder="Nombre" value="<?php echo $this->rol->getNombre(); ?>">
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar</button>


    
</form>



