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

<form class="form-horizontal" id="FormSoftware" method="post" action="<?php echo ROOT; ?>software/_guardar/<?php echo $this->software->getId(); ?>" autocomplete="off">
    <h4>Equipo</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->software->getId(); ?>">

    <div class="form-group ">
        <label for="Nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del Equipo" value="<?php echo $this->software->getNombre(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Descripcion" class="col-sm-3 control-label">Descripción</label>
        <div class="col-sm-5">
            <textarea class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion"><?php echo $this->software->getDescripcion(); ?></textarea>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Oculto" class="col-lg-3 control-label">Visibilidad</label>
        <div class="col-lg-5">
            <select name="Select_Oculto" id="Select_Oculto" class="form-control">
                <option value="Visible" <?php if ($this->software->getOculto() == 'Visible') echo 'selected'; ?> >Visible</option>
                <option value="Oculto" <?php if ($this->software->getOculto() == 'Oculto') echo 'selected'; ?> >Oculto</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Espacio" class="col-sm-3 control-label">Espacio</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Espacio" id="Select_Espacio" class="form-control">
                <?php
                foreach ($this->listaEspacios as $key => $espacio) {
                    if ($espacio->getId() == $this->software->getEspacio()->getId())
                        echo "<option value='{$espacio->getId()}' selected>{$espacio->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-3">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
    </div>

</form>

<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>


