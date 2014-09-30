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

<form class="form-horizontal" role="form" method="post" action="<?php echo ROOT; ?>usuario/_guardar/<?php echo $this->usuario->getMatricula(); ?>">
    <h4>Usuario</h4>
    <hr />
    <div class="form-group ">
        <label for="Matricula" class="control-label col-md-2">Matricula</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Matricula" name="Matricula" placeholder="Matricula" value="<?php echo $this->usuario->getMatricula(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Nombre" class="control-label col-md-2">Nombre(s)</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre(s)" value="<?php echo $this->usuario->getNombre(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Apellido" class="control-label col-md-2">Apellido(s)</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Apellido(s)" value="<?php echo $this->usuario->getApellido(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Correo" class="control-label col-md-2">Correo</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Correo" name="Correo" placeholder="Correo" value="<?php echo $this->usuario->getCorreo(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Contrasena" class="control-label col-md-2">Contraseña</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Contrasena" name="Contrasena" placeholder="Contraseña" value="<?php echo $this->usuario->getContrasena(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Fotografia" class="control-label col-md-2">Fotografia</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Fotografia" name="Fotografia" placeholder="Fotografia" value="<?php echo $this->usuario->getFotografia(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Select-Rol" class="control-label col-md-2">Rol</label>
        <div class="col-md-10">
            <select name="Select-Rol" id="Select-Rol" class="form-control">
                <option value="0">-- Selecciona Rol --</option>
                <?php
                foreach ($this->listaRoles as $key => $rol) {
                    if ($rol->getId() == $this->usuario->getRol()->getId())
                        echo "<option value='{$rol->getId()}' selected>{$rol->getNombre()}</option>";
                    else
                        echo "<option value='{$rol->getId()}'>{$rol->getNombre()}</option>";
                }
                ?>
            </select>
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







