<h2>Detalles</h2>

<div>
    <h4>Carrera</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>

        <dd>
            <?php echo $this->carrera->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>

        <dd>
            <?php echo $this->carrera->getNombre(); ?>
        </dd>
        
        <dt>
            Siglas
        </dt>

        <dd>
            <?php echo $this->carrera->getSiglas(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'carrera/editar/' . $this->carrera->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

