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

<form class="form-horizontal" id="FormDocumentoEspacio" method="post" enctype="multipart/form-data" action="<?php echo ROOT; ?>documentoEspacio/_guardar/<?php echo $this->documento->getId(); ?>" autocomplete="off">
    <h4>Documento Espacio</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" value="<?php echo $this->documento->getId(); ?>">
    <input type="hidden" class="form-control" id="EspacioId" name="EspacioId" value="<?php echo $this->documento->getEspacio()->getId(); ?>">




    <div class="form-group ">
        <input type="hidden" name="DocumentoDefault" id="DocumentoDefault" value="<?php echo $this->documento->getDocumento(); ?>">

        <label for="Documento" class="col-sm-3 control-label">Documento</label>
        <div class="col-sm-5">
            <input type="file" name="Documento" id="Documento">
        </div>
    </div>


    <div class="form-group ">
        <label for="Select_TipoDocumento" class="col-sm-3 control-label">Tipo Documento</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_TipoDocumento" id="Select_TipoDocumento" class="form-control">
                <option value="">-- Selecciona Tipo Documento --</option>
                <?php
                foreach ($this->listaTiposDocumento as $key => $tipoDocumento) {
                    if ($tipoDocumento->getId() == $this->documento->getTipoDocumento()->getId())
                        echo "<option value='{$tipoDocumento->getId()}' selected>{$tipoDocumento->getNombre()}</option>";
                    else
                        echo "<option value='{$tipoDocumento->getId()}'>{$tipoDocumento->getNombre()}</option>";
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


