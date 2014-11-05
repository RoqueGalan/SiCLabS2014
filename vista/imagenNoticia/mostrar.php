<h2>Detalles</h2>

<div>
    <h4>Imagen</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
        Id
        </dt>
        <dd>
            <?php echo $this->imagenNoticia->getId(); ?>
        </dd>

        <dt>
        Titulo
        </dt>
        <dd>
            <?php echo $this->imagenNoticia->getTitulo(); ?>
        </dd>

        <dt>
        Descripción
        </dt>
        <dd>
            <?php echo $this->imagenNoticia->getDescripcion(); ?>
        </dd>

        <dt>
        Noticia
        </dt>
        <dd>
            <?php echo $this->imagenNoticia->getNoticiaId(); ?>
        </dd>

        <dt>
        Imagen
        </dt>
        <dd>
            <a href="#" class="imagenPop" data-img-url="<?php echo ROOT . $this->imagenNoticia->getRuta() . $this->imagenNoticia->getImagen(); ?>">
                <img src="<?php echo ROOT . $this->imagenNoticia->getRuta() . 'mini/mini_' . $this->imagenNoticia->getImagen(); ?>" class="img-thumbnail" />
            </a>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'imagenNoticia/editar/' . $this->imagenNoticia->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

<!-- Modal -->
<div id="ModalImagenPop" class="modal fade" role="dialog" aria-labelledby="ImagenPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <img src="#" class="center-block" style="max-width:90%; height: auto; max-height: 70%; "/>
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>