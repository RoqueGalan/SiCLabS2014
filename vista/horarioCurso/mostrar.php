<h2>Detalles</h2>

<div>
    <h4>Horario: <?php echo $this->horario->getCurso()->getUda()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
        Id
        </dt>
        <dd>
            <?php echo $this->horario->getId(); ?>
        </dd>

        <dt>
        Dia
        </dt>
        <dd>
            <?php echo $this->horario->getDia(); ?>
        </dd>

        <dt>
        Inicio
        </dt>
        <dd>
            <?php echo $this->horario->getInicio(); ?>
        </dd>

        <dt>
        Fin
        </dt>
        <dd>
            <?php echo $this->horario->getFin(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'horarioCurso/editar/' . $this->horario->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>
