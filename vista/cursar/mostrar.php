<h2>Detalles</h2>

<div>
    <h4>Impartir:</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->impartir->getId(); ?>
        </dd>

        <dt>
            Curso
        </dt>
        <dd>
            <?php echo $this->impartir->getCurso()->getAsignatura()->getNombre(); ?> |
            <?php echo $this->impartir->getCurso()->getCiclo()->getNombre(); ?>
        </dd>
        
        <dt>
           Usuario
        </dt>
        <dd>
            <?php echo $this->impartir->getUsuario()->getMatricula(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'impartir/editar/' . $this->impartir->getId(); ?>" class="btn btn-link">Editar</a> |
    
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

