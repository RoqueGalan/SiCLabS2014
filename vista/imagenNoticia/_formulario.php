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

<form class="form-horizontal" id="FormImagenNoticia" method="post" enctype="multipart/form-data" action="<?php echo ROOT; ?>imagenNoticia/_guardar/<?php echo $this->imagenNoticia->getId(); ?>" autocomplete="off">
    <h4>Imagen Noticia</h4>
    <hr />
    <input type="hidden" class="form-control" id="Id" name="Id" value="<?php echo $this->imagenNoticia->getId(); ?>">
    <input type="hidden" class="form-control" id="NoticiaId" name="NoticiaId" value="<?php echo $this->imagenNoticia->getNoticiaId(); ?>">

    <div class="form-group ">
        <label for="Titulo" class="col-sm-3 control-label">Titulo</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="Titulo" name="Titulo" placeholder="Titulo de la imagen" value="<?php echo $this->imagenNoticia->getTitulo(); ?>">
        </div>
    </div>

    <div class="form-group ">
        <label for="Descripcion" class="col-sm-3 control-label">Descripción</label>
        <div class="col-sm-5">
            <textarea class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion"><?php echo $this->imagenNoticia->getDescripcion(); ?></textarea>
        </div>
    </div>

    <div class="form-group ">
        <label for="Imagen" class="col-sm-3 control-label">Imagen</label>
        <div class="col-sm-5">
            <input type="hidden" name="ImagenDefault" id="ImagenDefault" value="<?php echo $this->imagenNoticia->getImagen(); ?>">

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="height: 100px;">
                    <img  alt="Sin Imagen" src="<?php echo ROOT . 'public/img/noticia/mini/mini_' . $this->imagenNoticia->getImagen(); ?>">
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


    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-3">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
    </div>

</form>

<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>



<!-- Modal -->
<div id="ModalImagenPop" class="modal fade" role="dialog" aria-labelledby="ImagenPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <img src="#" class="center-block" style="max-width:80%; height: auto; max-height: 60%; "/>
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>

