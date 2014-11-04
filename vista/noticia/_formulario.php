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

<form class="form-horizontal" id="FormNoticia" method="post" action="<?php echo ROOT; ?>noticia/_guardar/<?php echo $this->noticia->getId(); ?>" autocomplete="off">
    <h4>Noticia</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->noticia->getId(); ?>">

    <div class="form-group ">
        <label for="Titulo" class="col-sm-3 control-label">Titulo</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Titulo" name="Titulo" placeholder="Titulo de la noticia" value="<?php echo $this->noticia->getTitulo(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Descripcion" class="col-sm-3 control-label">Descripción</label>
        <div class="col-sm-5">
            <textarea class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion"><?php echo $this->noticia->getDescripcion(); ?></textarea>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Espacio" class="col-sm-3 control-label">Espacio</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Espacio" id="Select_Espacio" class="form-control">
                <option value="">-- Selecciona Espacio --</option>
                <?php
                foreach ($this->listaEspacios as $key => $espacio) {
                    if ($espacio->getId() == $this->noticia->getEspacio()->getId())
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


