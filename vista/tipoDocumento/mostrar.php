<h2>Detalles</h2>

<div>
    <h4>Tipo Documento</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>

        <dd>
            <?php echo $this->tipoDocumento->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>

        <dd>
            <?php echo $this->tipoDocumento->getNombre(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'tipoDocumento/editar/' . $this->tipoDocumento->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

