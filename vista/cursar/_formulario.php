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

<form class="form-horizontal" id="FormImpartir" method="post" action="<?php echo ROOT; ?>impartir/_guardar/<?php echo $this->impartir->getId(); ?>" autocomplete="off">
    <h4>Curso</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->impartir->getId(); ?>">

    <div class="form-group ">
        <label for="Select_Curso" class="col-sm-3 control-label">Curso</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Curso" id="Select_Curso" class="form-control">
                <?php
                foreach ($this->listaCursos as $key => $curso) {
                    if ($curso->getId() == $this->impartir->getCurso()->getId())
                        echo "<option value='{$curso->getId()}' selected>{$curso->getAsignatura()->getNombre()} | {$curso->getCiclo()->getNombre()}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-5">
            <b>Filtrar Usuario</b>
        </div>
    </div>

    <div class="alert-info">
        <br>
        <div class="form-group ">
            <label for="B_Matricula" class="col-sm-3 control-label">Por Matricula</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <input type="text" class="form-control" id="B_Matricula" name="B_Matricula" placeholder="Matricula">
                    <span class="input-group-btn">
                        <button id="btn_matricula" class="btn btn-default btn_buscar" type="button">Buscar</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <label for="B_Nombre" class="col-sm-3 control-label">Por Nombre Completo</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <input type="text" class="form-control" id="B_Nombre" name="B_Nombre" placeholder="Nombre(s)">
                    <input type="text" class="form-control" id="B_Apellido" name="B_Apellido" placeholder="Apellido(s)">
                    <span class="input-group-btn">
                        <button id="btn_nombre" class="btn btn-default btn_buscar" type="button">Buscar</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <label for="B_Rol" class="col-lg-3 control-label">Por Rol</label>
            <div class="col-lg-5">
                <div class="input-group">
                    <select name="B_Rol" id="B_Rol" class="form-control">
                        <option value="">-- Selecciona Rol --</option>
                        <?php
                        foreach ($this->listaRoles as $key => $rol) {
                            echo "<option value='{$rol->getId()}'>{$rol->getNombre()}</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-btn">
                        <button id="btn_rol" class="btn btn-default btn_buscar" type="button">Buscar</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
            </div>
        </div>

    </div>

    <div class="form-group ">
        <label for="Select_Usuario" class="col-lg-3 control-label">Usuario</label>
        <div class="col-lg-5">
            <select name="Select_Usuario" id="Select_Usuario" class="form-control">
                <?php
                echo "<option value='{$this->usuario->getId()}'>{$this->usuario->getMatricula()} - {$this->usuario->getNombre()} {$this->usuario->getApellido()}</option>";
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


