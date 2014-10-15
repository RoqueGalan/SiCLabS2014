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

<form class="form-horizontal" id="FormEspacio" method="post" action="<?php echo ROOT; ?>espacio/_guardar/<?php echo $this->espacio->getId(); ?>" autocomplete="off">
    <h4>Espacio</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->espacio->getId(); ?>">

    <div class="form-group ">
        <label for="Nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del Espacio" value="<?php echo $this->espacio->getNombre(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Descripcion" class="col-sm-3 control-label">Descripción</label>
        <div class="col-sm-5">
            <textarea class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion"><?php echo $this->espacio->getDescripcion(); ?></textarea>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_TipoEspacio" class="col-sm-3 control-label">Tipo Espacio</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_TipoEspacio" id="Select_TipoEspacio" class="form-control">
                <option value="">-- Selecciona Tipo Espacio --</option>
                <?php
                foreach ($this->listaTiposEspacio as $key => $tipoEspacio) {
                    if ($tipoEspacio->getId() == $this->espacio->getTipoEspacio()->getId())
                        echo "<option value='{$tipoEspacio->getId()}' selected>{$tipoEspacio->getNombre()}</option>";
                    else
                        echo "<option value='{$tipoEspacio->getId()}'>{$tipoEspacio->getNombre()}</option>";
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


