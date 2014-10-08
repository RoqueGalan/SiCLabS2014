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


<form class="form-horizontal" method="post" id="FormPermisoRol" action="<?php echo ROOT . 'permisoRol/_guardar/' . $this->permisoRol->getId(); ?>" autocomplete="off">
    <h4>Permiso Rol</h4>
    <hr />
    <input type="hidden" name="Id" value="<?php echo $this->permisoRol->getId(); ?>" readonly />

    <div class="form-group">
        <label for="Select_Rol" class="col-lg-3 control-label">Rol</label>
        <div class="col-lg-5">
            <select name="Select_Rol" id="Select_Rol" class="form-control">
                <option value="">-- Selecciona Rol --</option>
                <?php
                foreach ($this->listaRoles as $key => $rol) {
                    if ($rol->getId() == $this->permisoRol->getRol()->getId())
                        echo "<option value='{$rol->getId()}' selected>{$rol->getNombre()}</option>";
                    else
                        echo "<option value='{$rol->getId()}'>{$rol->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Permiso" class="col-lg-3 control-label">Permiso</label>
        <div class="col-lg-5">
            <select name="Select_Permiso" id="Select_Permiso" class="form-control">
                <option value="">-- Selecciona Permiso --</option>
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
        <label for="Select_Estado" class="col-lg-3 control-label">Estado</label>
        <div class="col-lg-5">
            <select name="Select_Estado" id="Select-Estado" class="form-control">
                <option value="" >-- Selecciona Estado --</option>
                <option value="Activo" <?php if ($this->permisoRol->getEstado() == 'Activo') echo 'selected'; ?> >Activo</option>
                <option value="Inactivo" <?php if ($this->permisoRol->getEstado() == 'Inactivo') echo 'selected'; ?>>Inactivo</option>
            </select>
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







