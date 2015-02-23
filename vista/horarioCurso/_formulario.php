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

<form class="form-horizontal" id="FormHorarioCurso1111" method="post" action="<?php echo ROOT; ?>horarioCurso/_guardar/<?php echo $this->horario->getId(); ?>" autocomplete="off">
    <h4>Horario</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->horario->getId(); ?>">

    <div class="form-group ">
        <label for="Select_Dia" class="col-lg-3 control-label">Día</label>
        <div class="col-lg-5">
            <select name="Select_Dia" id="Select_Dia" class="form-control">
                <option value="" >- Selecciona el Día -</option>
                <option value="Lunes" <?php if ($this->horario->getDia() == 'Lunes') echo 'selected'; ?> >Lunes</option>
                <option value="Martes" <?php if ($this->horario->getDia() == 'Martes') echo 'selected'; ?> >Martes</option>
                <option value="Miércoles" <?php if ($this->horario->getDia() == 'Miércoles') echo 'selected'; ?> >Miércoles</option>
                <option value="Jueves" <?php if ($this->horario->getDia() == 'Jueves') echo 'selected'; ?> >Jueves</option>
                <option value="Viernes" <?php if ($this->horario->getDia() == 'Viernes') echo 'selected'; ?> >Viernes</option>
                <option value="Sábado" <?php if ($this->horario->getDia() == 'Sábado') echo 'selected'; ?> >Sábado</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="Inicio" class="col-sm-3 control-label">Hora Inicio</label>
        <div class="col-sm-5">
            <input type='time' class="form-control" name="Inicio" id="Inicio" step="1800" value="<?php echo $this->horario->getInicio(); 
            ?>"/>     
        </div>
    </div>
    
    <div class="form-group">
        <label for="Fin" class="col-sm-3 control-label">Hora Final</label>
        <div class="col-sm-5">
            <input type='time' class="form-control" name="Fin" id="Fin" step="1800" value="<?php echo $this->horario->getFin(); ?>"/>     
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Curso" class="col-sm-3 control-label">Curso</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Curso" id="Select_Curso" class="form-control">
                <?php
                foreach ($this->listaCursos as $key => $curso) {
                    if ($curso->getId() == $this->horario->getCurso()->getId())
                        echo "<option value='{$curso->getId()}' selected>{$curso->getAsignatura()->getnombre()}</option>";
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


