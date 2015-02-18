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

<form class="form-horizontal" id="FormCurso" method="post" action="<?php echo ROOT; ?>curso/_guardar/<?php echo $this->curso->getId(); ?>" autocomplete="off">
    <h4>Curso</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->curso->getId(); ?>">

    <div class="form-group ">
        <label for="Select_Uda" class="col-sm-3 control-label">Unidad de Aprendizaje</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Uda" id="Select_Uda" class="form-control">
                <option value="">-- Selecciona UDA --</option>
                <?php
                foreach ($this->listaUdas as $key => $uda) {
                    if ($uda->getId() == $this->curso->getUda()->getId())
                        echo "<option value='{$uda->getId()}' selected>{$uda->getCarrera()->getSiglas()} - {$uda->getAsignatura()->getNombre()}</option>";
                    else
                        echo "<option value='{$uda->getId()}'>{$uda->getCarrera()->getSiglas()} - {$uda->getAsignatura()->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Select_Grupo" class="col-sm-3 control-label">Grupo</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Grupo" id="Select_Grupo" class="form-control">
                <option value="">-- Selecciona Grupo --</option>
                <?php
                foreach ($this->listaGrupos as $key => $grupo) {
                    if ($grupo->getId() == $this->curso->getGrupo()->getId())
                        echo "<option value='{$grupo->getId()}' selected>{$grupo->getNombre()}</option>";
                    else
                        echo "<option value='{$grupo->getId()}'>{$grupo->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Select_Ciclo" class="col-sm-3 control-label">Ciclo</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Ciclo" id="Select_Ciclo" class="form-control">
                <option value="">-- Selecciona Ciclo --</option>
                <?php
                foreach ($this->listaCiclos as $key => $ciclo) {
                    if ($ciclo->getId() == $this->curso->getCiclo()->getId())
                        echo "<option value='{$ciclo->getId()}' selected>{$ciclo->getNombre()}</option>";
                    else
                        echo "<option value='{$ciclo->getId()}'>{$ciclo->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Descripcion" class="col-lg-3 control-label">Descripción</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" name="Descripcion" id="Descripcion" placeholder="Descripción" value="<?php echo $this->curso->getDescripcion(); ?>"/>
        </div>
    </div>
    
    <div class="form-group ">
        <label for="Select_Espacio" class="col-sm-3 control-label">Espacio</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Espacio" id="Select_Espacio" class="form-control">
                <?php
                foreach ($this->listaEspacios as $key => $espacio) {
                    if ($espacio->getId() == $this->curso->getEspacio()->getId())
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


