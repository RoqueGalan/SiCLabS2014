<h2>Detalles</h2>

<div>
    <h4>Espacio: <?php echo $this->espacio->getTipoEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->espacio->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>
        <dd>
            <?php echo $this->espacio->getNombre(); ?>
        </dd>
        
        <dt>
            Descripción
        </dt>
        <dd>
            <?php echo $this->espacio->getDescripcion(); ?>
        </dd>
        
        <dt>
            Tipo Espacio
        </dt>
        <dd>
            <?php echo $this->espacio->getTipoEspacio()->getNombre(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'espacio/editar/' . $this->espacio->getId(); ?>" class="btn btn-link">Editar</a> |
    <a href="<?php echo ROOT . 'noticia/index/' . $this->espacio->getId(); ?>" class="btn btn-link">Ver Noticias</a> |
    <a href="<?php echo ROOT . 'documentoEspacio/index/' . $this->espacio->getId(); ?>" class="btn btn-link">Ver Documentos</a> |
    <a href="<?php echo ROOT . 'equipo/index/' . $this->espacio->getId(); ?>" class="btn btn-link">Ver Equipo</a> |
    <a href="<?php echo ROOT . 'software/index/' . $this->espacio->getId(); ?>" class="btn btn-link">Ver Software</a> |
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

