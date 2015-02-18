<h2>Detalles</h2>

<div>
    <h4>Unidad de Aprendizaje</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->uda->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>
        <dd>
            <?php echo $this->uda->getAsignatura()->getNombre(); ?>
        </dd>
        
        <dt>
            Carrera
        </dt>
        <dd>
            <?php echo $this->uda->getCarrera()->getNombre(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'uda/editar/' . $this->uda->getId(); ?>" class="btn btn-link">Editar</a> |
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

