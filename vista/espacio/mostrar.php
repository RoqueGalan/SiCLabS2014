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
            <?php echo $this->espacio->getTipoEspacio()->getId(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'espacio/editar/' . $this->espacio->getId(); ?>" class="btn btn-link">Editar</a> |
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

