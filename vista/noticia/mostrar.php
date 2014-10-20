<h2>Detalles</h2>

<div>
    <h4>Noticia: <?php echo $this->noticia->getEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->noticia->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>
        <dd>
            <?php echo $this->noticia->getTitulo(); ?>
        </dd>
        
        <dt>
            Descripción
        </dt>
        <dd>
            <?php echo $this->noticia->getDescripcion(); ?>
        </dd>
        
        <dt>
            Fecha
        </dt>
        <dd>
            <?php echo $this->noticia->getFecha(); ?>
        </dd>
        
        <dt>
            <?php echo $this->noticia->getEspacio()->getTipoEspacio()->getNombre(); ?>
        </dt>
        <dd>
            <?php echo $this->noticia->getEspacio()->getNombre(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'noticia/editar/' . $this->noticia->getId(); ?>" class="btn btn-link">Editar</a>
    <a href="<?php echo ROOT . 'imagenNoticia/index/' . $this->noticia->getId(); ?>" class="btn btn-link">Ver Imagenes</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

