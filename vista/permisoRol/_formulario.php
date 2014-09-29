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


<form class="form-horizontal" role="form" method="post" action="<?php echo ROOT . 'permisoRol/_guardar/' . $this->permisoRol->getId(); ?>">
    <h4>Permiso Rol</h4>
    <hr />
    <input type="hidden" name="Id" value="<?php echo $this->permisoRol->getId(); ?>" readonly />

    <div class="form-group ">
        <label for="Select-Rol" class="control-label col-md-2">Rol</label>
        <div class="col-md-10">
            <select name="Select-Rol" id="Select-Rol" class="form-control">
                <option value="0">-- Selecciona Rol --</option>
                <?php
                foreach ($this->listaRoles as $key => $permisoRol) {
                    if ($permisoRol->getId() == $this->permisoRol->getRol()->getId())
                        echo "<option value='{$permisoRol->getId()}' selected>{$permisoRol->getNombre()}</option>";
                    else
                        echo "<option value='{$permisoRol->getId()}'>{$permisoRol->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select-Permiso" class="control-label col-md-2">Permiso</label>
        <div class="col-md-10">
            <select name="Select-Permiso" id="Select-Permiso" class="form-control">
                <option value="0">-- Selecciona Permiso --</option>
                <?php
                foreach ($this->listaPermisos as $key => $permiso) {
                    if ($permiso->getId() == $this->permisoRol->getPermiso()->getId())
                        echo "<option value='{$permiso->getId()}' selected>{$permiso->getNombre()}</option>";
                    else
                        echo "<option value='{$permiso->getId()}'>{$permiso->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>


    <div class="form-group ">
        <label for="Select-Estado" class="control-label col-md-2">Estado</label>
        <div class="col-md-10">
            <select name="Select-Estado" id="Select-Estado" class="form-control">
                <option value="error" >-- Selecciona Estado --</option>
                <option value="Activo" <?php if($this->permisoRol->getEstado() == 'Activo') echo 'selected';?> >Activo</option>
                <option value="Inactivo" <?php if($this->permisoRol->getEstado() == 'Inactivo') echo 'selected';?>>Inactivo</option>
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







