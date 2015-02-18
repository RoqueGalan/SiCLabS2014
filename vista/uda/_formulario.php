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

<form class="form-horizontal" id="FormUda" method="post" action="<?php echo ROOT; ?>uda/_guardar/<?php echo $this->uda->getId(); ?>" autocomplete="off">
    <h4>Unidad de Aprendizaje</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->uda->getId(); ?>">

    <div class="form-group ">
        <label for="Select_Asignatura" class="col-sm-3 control-label">Asignatura</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Asignatura" id="Select_Asignatura" class="form-control">
                <option value="">-- Selecciona Asignatura --</option>
                <?php
                foreach ($this->listaAsignaturas as $key => $asignatura) {
                    if ($asignatura->getId() == $this->uda->getAsignatura()->getId())
                        echo "<option value='{$asignatura->getId()}' selected>{$asignatura->getNombre()}</option>";
                    else
                        echo "<option value='{$asignatura->getId()}'>{$asignatura->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Carrera" class="col-sm-3 control-label">Carrera</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Carrera" id="Select_Carrera" class="form-control">
                <option value="">-- Selecciona Carrera --</option>
                <?php
                foreach ($this->listaCarreras as $key => $carrera) {
                    if ($carrera->getId() == $this->uda->getCarrera()->getId())
                        echo "<option value='{$carrera->getId()}' selected>{$carrera->getNombre()}</option>";
                    else
                        echo "<option value='{$carrera->getId()}'>{$carrera->getNombre()}</option>";
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


