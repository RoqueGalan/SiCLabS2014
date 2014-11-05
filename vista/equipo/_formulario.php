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

<form class="form-horizontal" id="FormEquipo" method="post" enctype="multipart/form-data" action="<?php echo ROOT; ?>equipo/_guardar/<?php echo $this->equipo->getId(); ?>" autocomplete="off">
    <h4>Equipo</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" placeholder="Id" value="<?php echo $this->equipo->getId(); ?>">

    <div class="form-group ">
        <label for="Nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del Equipo" value="<?php echo $this->equipo->getNombre(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Marca" class="col-sm-3 control-label">Marca</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Marca" name="Marca" placeholder="Marca" value="<?php echo $this->equipo->getMarca(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Modelo" class="col-sm-3 control-label">Modelo</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Modelo" name="Modelo" placeholder="Modelo" value="<?php echo $this->equipo->getModelo(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="NoSerie" class="col-sm-3 control-label">No. Serie</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="NoSerie" name="NoSerie" placeholder="Número de Serie" value="<?php echo $this->equipo->getNoSerie(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Condicion" class="col-lg-3 control-label">Condición</label>
        <div class="col-lg-5">
            <select name="Select_Condicion" id="Select-Estado" class="form-control">
                <option value="" >-- Selecciona Condición --</option>
                <option value="Excelente" <?php if ($this->equipo->getCondicion() == 'Excelente') echo 'selected'; ?> >Excelente</option>
                <option value="Bueno" <?php if ($this->equipo->getCondicion() == 'Bueno') echo 'selected'; ?> >Bueno</option>
                <option value="Regular" <?php if ($this->equipo->getCondicion() == 'Regular') echo 'selected'; ?> >Regular</option>
                <option value="Malo" <?php if ($this->equipo->getCondicion() == 'Malo') echo 'selected'; ?> >Malo</option>
                <option value="Pesimo" <?php if ($this->equipo->getCondicion() == 'Pesimo') echo 'selected'; ?> >Pésimo</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="Caracteristicas" class="col-sm-3 control-label">Caracteristicas</label>
        <div class="col-sm-5">
            <textarea class="form-control" id="Caracteristicas" name="Caracteristicas" placeholder="Caracteristicas"><?php echo $this->equipo->getCaracteristicas(); ?></textarea>
        </div>
    </div>

    <div class="form-group ">
        <label for="CantidadTotal" class="col-sm-3 control-label">Cantidad Total</label>
        <div class="col-sm-5">
            <input type="number" class="form-control" id="CantidadTotal" name="CantidadTotal" placeholder="0" value="<?php echo $this->equipo->getCantidadTotal(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="CodigoNacion" class="col-sm-3 control-label">Codigo Nación</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="CodigoNacion" name="CodigoNacion" placeholder="Codigo de la Nación" value="<?php echo $this->equipo->getCodigoNacion(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="CodigoUaem" class="col-sm-3 control-label">Codigo UAEM</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="CodigoUaem" name="CodigoUaem" placeholder="Codigo de la UAEM" value="<?php echo $this->equipo->getCodigoUaem(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Imagen" class="col-sm-3 control-label">Imagen</label>
        <div class="col-sm-5">
            <input type="hidden" name="ImagenDefault" id="ImagenDefault" value="<?php echo $this->equipo->getImagen(); ?>">

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="height: 100px;">
                    <img  alt="Sin Imagen" src="<?php echo ROOT . $this->equipo->getRutaImg() . 'mini/mini_' . $this->equipo->getImagen(); ?>">                   
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="height: 100px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">Seleccionar</span>
                        <span class="fileinput-exists">Cambiar</span>
                        <input type="file" name="Imagen" id="Imagen">
                    </span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group ">
        <input type="hidden" name="DocumentoDefault" id="DocumentoDefault" value="<?php echo $this->equipo->getDocumento(); ?>">
        <label for="Documento" class="col-sm-3 control-label">Documento</label>
        <div class="col-sm-5">
            <input type="file" name="Documento" id="Documento">
            <p class="help-block">Documentación del equipo</p>
        </div>
        
    </div>
    
    <div class="form-group ">
        <label for="Select_Oculto" class="col-lg-3 control-label">Visibilidad</label>
        <div class="col-lg-5">
            <select name="Select_Oculto" id="Select_Oculto" class="form-control">
                <option value="Visible" <?php if ($this->equipo->getOculto() == 'Visible') echo 'selected'; ?> >Visible</option>
                <option value="Oculto" <?php if ($this->equipo->getOculto() == 'Oculto') echo 'selected'; ?> >Oculto</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="Select_Espacio" class="col-sm-3 control-label">Espacio</label>
        <div class="col-sm-5 selectContainer">
            <select name="Select_Espacio" id="Select_Espacio" class="form-control">
                <?php
                foreach ($this->listaEspacios as $key => $espacio) {
                    if ($espacio->getId() == $this->equipo->getEspacio()->getId())
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


