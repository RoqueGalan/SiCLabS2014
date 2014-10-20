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
            <a href="<?php echo ROOT . 'public/img/noticia/' . $this->imagenNoticia->getImagen(); ?>">
                <img src="<?php echo ROOT . 'public/img/noticia/mini/mini_' . $this->imagenNoticia->getImagen(); ?>" class="img-thumbnail" />
            </a>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'imagenNoticia/editar/' . $this->imagenNoticia->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

