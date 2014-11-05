<h2>Detalles</h2>

<div>
    <h4>Grupo</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>

        <dd>
            <?php echo $this->grupo->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>

        <dd>
            <?php echo $this->grupo->getNombre(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'grupo/editar/' . $this->grupo->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

