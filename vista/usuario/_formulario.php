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

<form class="form-horizontal" id="FormUsuario" method="post" action="<?php echo ROOT; ?>usuario/_guardar/<?php echo $this->usuario->getId(); ?>" autocomplete="off">
    <h4>Usuario</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->usuario->getId(); ?>">
    
    <div class="form-group ">
        <label for="Matricula" class="col-lg-3 control-label">Matricula</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="Matricula" name="Matricula" placeholder="Matricula" value="<?php echo $this->usuario->getMatricula(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Nombre" class="col-lg-3 control-label">Nombre(s)</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre(s)" value="<?php echo $this->usuario->getNombre(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Apellido" class="col-lg-3 control-label">Apellido(s)</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Apellido(s)" value="<?php echo $this->usuario->getApellido(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Correo" class="col-lg-3 control-label">Correo</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="Correo" name="Correo" placeholder="Correo" value="<?php echo $this->usuario->getCorreo(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Contrasena" class="col-lg-3 control-label">Contraseña</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="Contrasena" name="Contrasena" placeholder="Contraseña" value="<?php echo $this->usuario->getContrasena(); ?>">
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Select_Rol" class="col-lg-3 control-label">Rol</label>
        <div class="col-lg-5">
            <select name="Select_Rol" id="Select_Rol" class="form-control">
                <option value="">-- Selecciona Rol --</option>
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
        <div class="col-lg-9 col-lg-offset-3">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
    </div>

</form>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>







