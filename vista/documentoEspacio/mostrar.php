<h2>Detalles</h2>

<div>
    <h4>Noticia: <?php echo $this->documento->getEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->documento->getId(); ?>
        </dd>

        <dt>
            Documento
        </dt>
        <dd>
            <?php echo $this->documento->getDocumento(); ?>
        </dd>
        
        <dt>
            Tipo Documento
        </dt>
        <dd>
            <?php echo $this->documento->getTipoDocumento()->getNombre(); ?>
        </dd>
        
        <dt>
            <?php echo $this->documento->getEspacio()->getTipoEspacio()->getNombre(); ?>
        </dt>
        <dd>
            <?php echo $this->documento->getEspacio()->getNombre(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'documentoEspacio/editar/' . $this->noticia->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

